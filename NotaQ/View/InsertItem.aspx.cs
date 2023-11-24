using NotaQ.Model;
using NotaQ.Repository;
using System;

namespace NotaQ.View
{
    public partial class InsertItem : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            user olduser = Session["user"] as user;
            if (olduser == null)
            {
                Response.Redirect("Login.aspx");
            }
        }

        protected void btnAdd_Click(object sender, EventArgs e)
        {
            string name = tbName.Text;
            string description = tbDescription.Text;
            int price = Convert.ToInt32(tbPrice.Text.ToString());
            int stock = Convert.ToInt32(tbStock.Text.ToString());
            int id = Convert.ToInt32(Request.QueryString["id"]);
            //product newProduct = ProductFactory.createProduct(id, name, price, stock, description);
            ProductRepo.AddProduct(id, name, price, stock, description);
            Response.Redirect("ItemList.aspx");
        }
    }
}