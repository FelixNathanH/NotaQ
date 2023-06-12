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

        protected void Page_Load(object sender, EventArgs e)
        {
                TableRepeater.DataSource = CartRepo.GetCart();
            TableRepeater.DataBind();
            
            
            buyDate.Text = waktu.ToString();

        }

        protected void DeleteLinkBtn_Click(object sender, EventArgs e)
        {
            LinkButton linkbtn = (LinkButton)sender;
            string cartIdTmp = linkbtn.CommandArgument;
            int cartId = int.Parse(cartIdTmp);
            CartRepo.DeleteCart(cartId);


            
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
                productError.Text = "produk tidak ditemukan, untuk produk tidak terdaftar, harap masukan harga produk secara manual";
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

            if(found == true)
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
                price = int.Parse(productPrice.Text);
                quantity = int.Parse(productQuantity.Text);
                newCart = CartFactory.createCart(id, name, price, quantity);
            }
            CartRepo.AddCart(newCart);

            int total=0;
            List<cart> cartList = CartRepo.GetCart();
            
            foreach (cart x in cartList)
            {
                total += x.cart_product_price;
            }

            
            Response.Redirect(Request.RawUrl);
            found = false;
        }

        protected void kirim_nota_Click(object sender, EventArgs e)
        {
            List<cart> cartList = CartRepo.GetCart();
            int sum = 0;
            foreach(cart x in cartList)
            {
                sum += x.cart_product_price;
            }

            string buyerNm = buyer.Text;
            string buyerPhn = buyerPhone.Text;
            string buyerAssist = buyerAssistant.Text;
            string payMethod = Request.Form["pembayaran"];
            int paid = int.Parse(payment.Text);
            nota newNota = NotaFactory.createNota(buyerNm, buyerPhn, waktu, buyerAssist, sum, paid, payMethod,1);
            NotaRepo.AddNota(newNota);

            foreach (cart x in cartList)
            {
                int cartProductId = x.cart_product_id ?? 0;
                nota_detail newNotaDetail = NotaDetailFactory.createNotaDetail(newNota.Id, cartProductId, x.cart_product_name, x.cart_product_price, x.cart_product_quantity);
                if(x.cart_product_id != null)
                {
                    product z = ProductRepo.SearchProductById(cartProductId);
                    z.product_stock -= x.cart_product_quantity;
                }
            }

            string messages = buyerNm + buyerAssist + sum + paid + payMethod;
            string cleanNum = buyerPhn.TrimStart('0');
            string phoneNumber = "+62" + cleanNum;
            Whatsapp.Twilio.SendNota(phoneNumber, messages);

            foreach (cart x in cartList)
            {
                CartRepo.DeleteAllCart(x.Id);
            }



        }
    }
}
