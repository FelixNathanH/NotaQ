using NotaQ.Controller;
using NotaQ.Factory;
using NotaQ.Model;
using NotaQ.Repository;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace NotaQ.View
{


    public partial class MakeNota : System.Web.UI.Page
    {
        bool found = false, noStock=false;
        product productFound;
        DateTime waktu = DateTime.Now;
        int uid;

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

            //tulis ulang biar gk ilang di kolom atas
            if (Session["tempNam"] != null || Session["tempPhn"] != null || Session["tmpAst"] != null)
            {
                buyer.Text = (string)Session["tempNam"];
                buyerPhone.Text = (string)Session["tempPhn"];
                buyerAssistant.Text = (string)Session["tmpAst"];
            }


            TableRepeater.DataSource = CartRepo.GetCart();
            TableRepeater.DataBind();
            int total = 0;
            List<cart> cartList = CartRepo.GetCart();

            foreach (cart x in cartList)
            {
                total += x.cart_product_price;
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
                errorFound.Text = "produk tidak ditemukan, untuk produk tidak terdaftar, harap masukan harga produk secara manual";
                productQuantity.Text = "1";
                found = false;
            }

            GridViewCart.DataSource = productsFound;
            GridViewCart.DataBind();
        }

        protected void tambah_produk_Click(object sender, EventArgs e)
        {
            string errors = "";
            int price,qty, id, stock; 
            cart newCart;
            qty = price = id = 0;

            string name = productNameSearch.Text;
            string priceS = productPrice.Text; 
            string qtyS = productQuantity.Text;

            if (string.IsNullOrEmpty(name))
            {
                errorName.Text = "Nama produk tidak bisa kosong, silahkan cari kembali diatas atau isi manual";
            }

            //cek error harga
            string priceErr = Controller.NotaController.validateProductPrice(productPrice.Text);
            if (string.IsNullOrEmpty(priceErr))
            {
                errorPrice.Text = priceErr;
                errors += priceErr;
            }
            else
            {
                price = int.Parse(productPrice.Text);
            }

            //cek error jumlah beli
            string qtyeErr = Controller.NotaController.validateProductPrice(productQuantity.Text);
            if (string.IsNullOrEmpty(qtyeErr))
            {
                errorPrice.Text = qtyeErr;
                errors += qtyeErr;
            }
            else
            {
                qty = int.Parse(productQuantity.Text);
            }

            //misal produknya ada di database
            if (found == true && string.IsNullOrEmpty(errors))
            {
                id = productFound.Id;
                stock = productFound.product_stock ?? -1;

                if(stock!= -1)
                {
                    if (stock < qty && noStock == false)
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

            //klo no error gas
            if (string.IsNullOrEmpty(errors) && noStock==true)
            {
                newCart = CartFactory.createCart(id, name, price, qty);
                CartRepo.AddCart(newCart);

                Session["tempNam"] = buyer.Text;
                Session["tempPhn"] = buyerPhone.Text;
                Session["tmpAst"] = buyerAssistant.Text;
                Response.Redirect(Request.RawUrl);
                found = false;
            }
        }

        protected void kirim_nota_Click(object sender, EventArgs e)
        {
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
                priceSum += x.cart_product_price;
                productCnt += 1;
            }

            string buyerNm = buyer.Text;
            string buyerPhn = buyerPhone.Text;
            string buyerAssist = buyerAssistant.Text;
            string payMethod = Request.Form["pembayaran"];
            string paidAmount = payment.Text;

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
                    totalBelanja += x.cart_product_price * x.cart_product_quantity;
                    int cartProductId = x.cart_product_id ?? 0;

                    //list barang dibeli
                    barangDibeli = $"{cnt}) {x.cart_product_name,-20} {Controller.NotaController.toCurrency(x.cart_product_price),-16} x{x.cart_product_quantity,-14} {Controller.NotaController.toCurrency(totalBelanja)}\n";

                    nota_detail newNotaDetail = NotaDetailFactory.createNotaDetail(newNota.Id, cartProductId, x.cart_product_name, x.cart_product_price, x.cart_product_quantity);

                    if (x.cart_product_id != null)
                    {
                        product z = ProductRepo.SearchProductById(cartProductId);
                        if(z.product_stock > x.cart_product_quantity)
                        {
                            z.product_stock -= x.cart_product_quantity;
                        }
                        else
                        {
                            z.product_stock = 0;
                        }
                        
                    }
                }
                //buat kirim ke WA
                if (!string.IsNullOrEmpty(buyerPhn)){
                    string header = "No   Nama Barang          Harga            Jumlah         Total Belanja";
                    string messages = "Nama Pembeli: " + buyerNm + "\n" + "Dilayani oleh: " + buyerAssist + "\n\n" + header + barangDibeli + "\n\n" + "Total pembelian: " + priceSum + "\n" + "Dibayar: "
                        + paidAmount + "\n" + "Metode Pembayaran: " + payMethod;

                    string phoneNumber = Controller.NotaController.ConvertPhn(buyerPhn);
                    Whatsapp.Twilio.SendNota(phoneNumber, messages);
                }

                Session["tempNam"] = "";
                Session["tempPhn"] = "";
                Session["tmpAst"] = "";

                foreach (cart x in cartList)
                {
                    CartRepo.DeleteAllCart(x.Id);
                }
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
