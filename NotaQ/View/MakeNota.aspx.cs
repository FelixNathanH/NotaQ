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
        bool found = false;
        product productFound;
        DateTime waktu = DateTime.Now;
        int uid;

        protected void Page_Load(object sender, EventArgs e)
        {
            if (Session["user"] != null)
            {
                string sUid = (string)Session["user"];
                int.TryParse(sUid, out uid);
            }
            else
            {
                Response.Redirect("Login.aspx");
            }

            if(Session["tempNam"] != null || Session["tempPhn"] != null || Session["tmpAst"] != null)
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

            totalLbl.Text = "Total harga: Rp." + total.ToString();

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
            List<product> productsFound = ProductRepo.SearchProductsByName(name);
            product productFound = ProductRepo.SearchProductByName(name);

            if (productFound != null)
            {
                Productname.Text = productFound.product_name.ToString();
                productPrice.Text = productFound.product_price.ToString(); ;
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
            string name;
            int id, price, quantity, stock;
            cart newCart;

            if (found == true)
            {
                name = productFound.product_name;
                id = productFound.Id;
                price = productFound.product_price;
                quantity = int.Parse(productQuantity.Text);
                newCart = CartFactory.createCart(id, name, price, quantity);
            }
            else
            {
                name = productNameSearch.Text;
                id = 0;
                if (!Controller.NotaController.checkNull(productPrice.Text))
                {
                    price = int.Parse(productPrice.Text);
                    quantity = int.Parse(productQuantity.Text);
                    newCart = CartFactory.createCart(id, name, price, quantity);
                    CartRepo.AddCart(newCart);
                }

            }

            Session["tempNam"] = buyer.Text;
            Session["tempPhn"] = buyerPhone.Text;
            Session["tmpAst"] = buyerAssistant.Text;
            Response.Redirect(Request.RawUrl);
            found = false;
        }

        protected void kirim_nota_Click(object sender, EventArgs e)
        {
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

            //VALIDATE
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

                foreach (cart x in cartList)
                {
                    int cartProductId = x.cart_product_id ?? 0;
                    nota_detail newNotaDetail = NotaDetailFactory.createNotaDetail(newNota.Id, cartProductId, x.cart_product_name, x.cart_product_price, x.cart_product_quantity);
                    if (x.cart_product_id != null)
                    {
                        product z = ProductRepo.SearchProductById(cartProductId);
                        z.product_stock -= x.cart_product_quantity;
                    }
                }

                string messages = buyerNm + buyerAssist + priceSum + paidAmount + payMethod; //need update

                string phoneNumber = Controller.NotaController.ConvertPhn(buyerPhn);
                Whatsapp.Twilio.SendNota(phoneNumber, messages);

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
