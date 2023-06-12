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

        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void DeleteLinkBtn_Click(object sender, EventArgs e)
        {

        }

        protected void search_product_Click(object sender, EventArgs e)
        {
            string name = productNameSearch.Text;
            List<product> productsFound = ProductRepo.SearchProductsByName(name);
            product productFound = ProductRepo.SearchProductByName(name);

            if (productFound != null)
            {
                string price = productFound.product_price.ToString();

                productPrice.Text = price;
                found = true;
            }
            else
            {
                productError.Text = "produk tidak ditemukan, untuk produk tidak terdaftar, harap masukan harga produk secara manual";
                productQuantity.Text = "1";
                found = false;
            }
        }

        protected void tambah_produk_Click(object sender, EventArgs e)
        {
            string name;
            int id, price, quantity, stock;

            if(found == true)
            {
                name = productFound.product_name;
                id = productFound.Id;
                price = productFound.product_price;
                quantity = int.Parse(productQuantity.Text);

            }
        }

        
    }
}
