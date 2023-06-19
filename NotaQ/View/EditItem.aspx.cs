using NotaQ.Repository;
using System;

namespace NotaQ.View
{
    public partial class EditItem : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }
        protected void btnUpdate_Click(object sender, EventArgs e)
        {
            string name = tbName.Text;
            string description = tbDescription.Text;
            int price = Convert.ToInt32(tbPrice.Text);
            int stock = Convert.ToInt32(tbStock.Text);
            int id = Convert.ToInt32(Request.QueryString["id"]);

            ProductRepo.editProduct(id, name, price, stock, description);
            Response.Redirect("ItemList.aspx");
        }
    }
}