using NotaQ.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web.UI.WebControls;

namespace NotaQ.View
{
    public partial class ItemList : System.Web.UI.Page
    {
        DatabaseEntities db = new DatabaseEntities();
        protected void Page_Load(object sender, EventArgs e)
        {
            user olduser = Session["user"] as user;
            if (olduser == null)
            {
                Response.Redirect("Login.aspx");
            }

            if (IsPostBack == false)
            {
                List<product> products = (db.product).ToList();

                GridView1.DataSource = products;
                GridView1.DataBind();
            }
        }

        protected void urutkan_Click(object sender, EventArgs e)
        {
            string sortExpression = ViewState["SortExpression"] as string;
            SortDirection sortDirection = SortDirection.Ascending;

            if (sortExpression == "product_name")
            {
                sortDirection = ViewState["SortDirection"] as SortDirection? ?? SortDirection.Ascending;
                sortDirection = (sortDirection == SortDirection.Ascending) ? SortDirection.Descending : SortDirection.Ascending;
            }
            else
            {
                sortExpression = "product_name";
                sortDirection = SortDirection.Ascending;
            }


            ViewState["SortExpression"] = sortExpression;
            ViewState["SortDirection"] = sortDirection;

            SortGridViewItem(sortExpression, sortDirection);
        }

        private void SortGridViewItem(string sortExpression, SortDirection sortDirection)
        {
            List<product> dataSource = (db.product).ToList();


            if (sortDirection == SortDirection.Ascending)
            {
                dataSource = dataSource.OrderBy(x => x.product_name).ToList();
            }
            else
            {
                dataSource = dataSource.OrderByDescending(x => x.product_name).ToList();
            }
            GridView1.DataSource = dataSource;
            GridView1.DataBind();
        }

        protected void search_TextChanged1(object sender, EventArgs e)
        {
            string keyword = search.Text.Trim();
            List<product> dataSource = (db.product).ToList();
            dataSource = dataSource.Where(x => x.product_name.ToLower().Contains(keyword.ToLower())).ToList();
            GridView1.DataSource = dataSource;
            GridView1.DataBind();
        }

        protected void GridView1_RowDeleting(object sender, GridViewDeleteEventArgs e)
        {
            GridViewRow row = GridView1.Rows[e.RowIndex];
            string idstring = row.Cells[0].Text;
            int id = Convert.ToInt32(idstring);

            product h = db.product.Find(id);
            db.product.Remove(h);
            db.SaveChanges();
            Response.Redirect("~/View/ItemList.aspx");
        }

        protected void GridView1_RowEditing(object sender, GridViewEditEventArgs e)
        {
            GridViewRow row = GridView1.Rows[e.NewEditIndex];
            string id = row.Cells[0].Text.ToString();
            Response.Redirect("~/View/EditItem.aspx?id=" + id);
        }

        protected void tambah_produk_Click(object sender, EventArgs e)
        {
            user customer = Session["user"] as user;
            int id = customer.Id;
            Response.Redirect("InsertItem.aspx?id=" + id);
        }
    }
}
