﻿using NotaQ.Factory;
using NotaQ.Model;
using NotaQ.Repository;
using System;
using System.Collections.Generic;
using System.Web.UI.WebControls;

namespace NotaQ.View
{


    public partial class MakeNota : System.Web.UI.Page
    {
        bool found = false, noStock = false;
        product productFound;
        DateTime waktu = DateTime.Now;
        int uid, total;
        string namToko;

        protected void Page_Load(object sender, EventArgs e)
        {
            user olduser = Session["user"] as user;
            if (olduser != null)
            {
                uid = olduser.Id;
            }
            else
            {
                Response.Redirect("Login.aspx");
            }
            namToko = namaToko.Text = "Toko " + olduser.name;

            //tulis ulang biar gk ilang di kolom atas
            string tempNam = Session["tempNam"] as string;
            string tempPhn = Session["tempPhn"] as string;
            string tmpAst = Session["tmpAst"] as string;

            if (tempNam != null || tempPhn != null || tmpAst != null)
            {
                buyer.Text = tempNam;
                buyerPhone.Text = tempPhn;
                buyerAssistant.Text = tmpAst;
            }


            TableRepeater.DataSource = CartRepo.GetCart();
            TableRepeater.DataBind();
            List<cart> cartList = CartRepo.GetCart();

            total = 0;
            int productPrice;
            foreach (cart item in cartList)
            {
                productPrice = item.cart_product_price * item.cart_product_quantity;
                total = total + productPrice;
            }

            totalLbl.Text = "Total harga: " + Controller.NotaController.toCurrency(total);

            buyDate.Text = waktu.ToString();

        }

        protected void DeleteLinkBtn_Click(object sender, EventArgs e)
        {
            LinkButton linkbtn = (LinkButton)sender;
            string cartIdTmp = linkbtn.CommandArgument;
            int cartId = int.Parse(cartIdTmp);
            CartRepo.DeleteCart(cartId);

            Session["tempNam"] = buyer.Text;
            Session["tempPhn"] = buyerPhone.Text;
            Session["tmpAst"] = buyerAssistant.Text;
            Response.Redirect(Request.RawUrl);
        }

        protected void search_product_Click(object sender, EventArgs e)
        {
            Session["tempNam"] = buyer.Text;
            Session["tempPhn"] = buyerPhone.Text;
            Session["tmpAst"] = buyerAssistant.Text;
            string name = productNameSearch.Text;
            if (string.IsNullOrEmpty(name))
            {
                errorFound.Text = "Pencarian harus diisi";
            }
            List<product> productsFound = ProductRepo.SearchProductsByName(name);
            product productFound = ProductRepo.SearchProductByName(name);

            if (productFound != null)
            {
                Productname.Text = productFound.product_name.ToString();
                productPrice.Text = productFound.product_price.ToString();
                productQuantity.Text = "1";
                found = true;
            }
            else
            {
                Productname.Text = productNameSearch.Text;
                errorFound.Text = "produk tidak ditemukan. Untuk produk tidak terdaftar, harap masukan harga produk secara manual";
                productQuantity.Text = "1";
                found = false;
            }


            GridViewCart.DataSource = productsFound;
            GridViewCart.DataBind();
        }

        //tambah produk
        protected void tambah_produk_Click(object sender, EventArgs e)
        {
            // simpan input
            Session["tempNam"] = buyer.Text;
            Session["tempPhn"] = buyerPhone.Text;
            Session["tmpAst"] = buyerAssistant.Text;

            string errors = "";
            int price, qty, id, stock;
            cart newCart;
            qty = price = id = 0;

            string name = Productname.Text;
            string priceS = productPrice.Text;
            string qtyS = productQuantity.Text;

            if (string.IsNullOrEmpty(name))
            {
                errorName.Text = "Nama produk tidak bisa kosong, silahkan cari kembali diatas atau isi manual";
            }

            // Validasi price
            string priceErr = Controller.NotaController.validateProductPrice(priceS);
            if (!string.IsNullOrEmpty(priceErr))
            {
                errorPrice.Text = priceErr;
                errors += priceErr;
            }
            else
            {
                price = int.Parse(priceS);
            }

            // validasi quantity
            string qtyeErr = Controller.NotaController.validateProductQuantity(qtyS);
            if (!string.IsNullOrEmpty(qtyeErr))
            {
                errorQuantity.Text = qtyeErr;
                errors += qtyeErr;
            }
            else
            {
                qty = int.Parse(qtyS);
            }

            // kalo produk ada di database & no error
            if (found && string.IsNullOrEmpty(errors))
            {
                id = productFound.Id;
                stock = productFound.product_stock ?? -1;

                // Cek stok
                if (stock != -1)
                {
                    if (stock < qty && !noStock)
                    {
                        errorQuantity.Text = "Stok tidak mencukupi permintaan\n Apabila tetap ingin melakukan order tekan kembali tombol [Tambah Produk]";
                        noStock = true;
                    }
                    else
                    {
                        noStock = false;
                    }
                }
            }

            // gk error gas
            if (string.IsNullOrEmpty(errors) && !noStock)
            {
                int srcId = Repository.CartRepo.findByName(name);
                if (srcId != -1)
                {
                    Repository.CartRepo.updateQuantity(srcId, qty);
                }
                else
                {
                    newCart = CartFactory.createCart(id, name, price, qty);
                    CartRepo.AddCart(newCart);
                }

                found = false;
                Response.Redirect(Request.RawUrl);
            }
        }



        protected void kirim_nota_Click(object sender, EventArgs e)
        {
            Session["tempNam"] = buyer.Text;
            Session["tempPhn"] = buyerPhone.Text;
            Session["tmpAst"] = buyerAssistant.Text;
            string barangDibeli = "";
            string errors = "";
            errorBuyer.Text = "";
            errorPhn.Text = "";
            errorQuantity.Text = "";
            errorPayment.Text = "";

            List<cart> cartList = CartRepo.GetCart();
            int priceSum = 0;
            int productCnt = 0;
            foreach (cart x in cartList)
            {
                priceSum += (x.cart_product_price * x.cart_product_quantity);
                productCnt += 1;
            }

            string buyerNm = buyer.Text;
            string buyerPhn = buyerPhone.Text;
            string buyerAssist = buyerAssistant.Text;
            string payMethod = Request.Form["pembayaran"];
            string paidAmount = payment.Text;

            if (paidAmount == "")
            {
                paidAmount = "0";
            }

            //validasi
            string buyerNmE = Controller.NotaController.ValidateBuyerName(buyerNm);
            string buyerPhnE = Controller.NotaController.ValidateBuyerPhone(buyerPhn);
            string buyerAssistsE = Controller.NotaController.ValidateBuyerAssistant(buyerAssist);
            string productCntE = Controller.NotaController.ValidateProduct(productCnt);
            string paidAmountE = Controller.NotaController.ValidatePaid(paidAmount);

            errors = buyerNmE + buyerPhnE + buyerAssistsE + productCntE + paidAmountE;

            if (string.IsNullOrEmpty(errors))
            {
                int payAmount = Controller.NotaController.ConvertToInt(paidAmount);
                nota newNota = NotaFactory.createNota(buyerNm, buyerPhn, waktu, buyerAssist, priceSum, payAmount, payMethod, uid);
                NotaRepo.AddNota(newNota);
                int totalBelanja = 0;
                int cnt = 0;
                foreach (cart x in cartList)
                {
                    cnt++;
                    totalBelanja += (x.cart_product_price * x.cart_product_quantity);
                    int cartProductId = x.cart_product_id ?? 0;

                    //list barang dibeli
                    barangDibeli += cnt.ToString() + ") " + x.cart_product_name + "    " + Controller.NotaController.toCurrency(x.cart_product_price) + "    x"
                        + x.cart_product_quantity + "    " + Controller.NotaController.toCurrency(totalBelanja) + "\n";
                    nota_detail newNotaDetail = NotaDetailFactory.createNotaDetail(newNota.Id, cartProductId, x.cart_product_name, x.cart_product_price, x.cart_product_quantity);

                    if (x.cart_product_id != null)
                    {
                        int idP = Repository.ProductRepo.SearchNameForId(x.cart_product_name);
                        if (idP != -1)
                        {
                            Repository.ProductRepo.UpdateProductStockById(idP, x.cart_product_quantity);
                        }

                    }
                }
                //buat kirim ke WA
                if (!string.IsNullOrEmpty(buyerPhn))
                {

                    int paid = int.Parse(paidAmount);
                    string phoneNumber = Controller.NotaController.ConvertPhn(buyerPhn);

                    string messages = namToko + "\n" + "Nama Pembeli: " + buyerNm + "\n" + "Dilayani oleh: " + buyerAssist + "\n" + "Barang yang dibeli: \n" + barangDibeli + "\n" + "Total pembelian: " + Controller.NotaController.toCurrency(priceSum) + "\n" + "Dibayar: "
                        + Controller.NotaController.toCurrency(paid) + "\n" + "Metode Pembayaran: " + payMethod;

                    if (priceSum > paid)
                    {
                        messages += "\n" + "Hutang: " + Controller.NotaController.toCurrency(priceSum - paid);
                        hutang newHutang = HutangFactory.createHutang(newNota.Id, buyerNm, "", buyerPhn, "", DateTime.Now, 0, priceSum - paid, uid);
                        Repository.HutangRepo.AddHutang(newHutang);
                    }
                    else if (priceSum < paid)
                    {
                        messages += "\n" + "Kemabalian: " + Controller.NotaController.toCurrency(paid - priceSum);
                    }


                    Whatsapp.Twilio.SendNota(phoneNumber, messages);
                }

                foreach (cart x in cartList)
                {
                    if (x.cart_product_id != null)
                    {
                        int idP = Repository.ProductRepo.SearchNameForId(x.cart_product_name);
                        if (idP != -1)
                        {
                            Repository.ProductRepo.UpdateProductStockById(idP, x.cart_product_quantity);
                        }
                    }
                }

                Session.Remove("tempNam");
                Session.Remove("tempPhn");
                Session.Remove("tmpAst");

                foreach (cart x in cartList)
                {
                    CartRepo.DeleteAllCart(x.Id);
                }

                Response.Redirect(Request.RawUrl);
            }
            else
            {
                errorBuyer.Text = buyerNmE;
                errorPhn.Text = buyerPhnE;
                errorQuantity.Text = productCntE;
                errorPayment.Text = paidAmountE;
            }

        }
    }
}
