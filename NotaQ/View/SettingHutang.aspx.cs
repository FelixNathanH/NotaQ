using NotaQ.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web.UI.WebControls;

namespace NotaQ.View
{
    public partial class SettingHutang : System.Web.UI.Page
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
                int userID = Convert.ToInt32(((user)Session["user"]).Id);
                List<hutang> listUtang = db.hutang.Where(x => x.user_id == userID).ToList();

                GridViewUtang.DataSource = listUtang;
                GridViewUtang.DataBind();
            }
        }

        protected void GridViewUtang_RowEditing(object sender, GridViewEditEventArgs e)
        {
            GridViewRow row = GridViewUtang.Rows[e.NewEditIndex];
            string idstring = row.Cells[0].Text;
            int id = Convert.ToInt32(idstring);


            hutang h = db.hutang.Find(id);
            nota n = db.nota.Find(h.nota_id);

            int deadline = Convert.ToInt32(batasutang.Text);
            h.debtor_deadline = n.buy_date.AddDays(deadline);

            h.debt_reminder_frequency = Convert.ToInt32(frekuensipengingat.Text);

            db.SaveChanges();
            Response.Redirect("~/View/SettingHutang.aspx");
        }

        protected void GridViewUtang_RowDeleting(object sender, GridViewDeleteEventArgs e)
        {
            GridViewRow row = GridViewUtang.Rows[e.RowIndex];
            string idstring = row.Cells[0].Text;
            int id = Convert.ToInt32(idstring);

            hutang h = db.hutang.Find(id);
            db.hutang.Remove(h);
            db.SaveChanges();
            Response.Redirect("~/View/SettingHutang.aspx");
        }

        protected void urutkan_Click(object sender, EventArgs e)
        {
            string sortExpression = ViewState["SortExpression"] as string;
            SortDirection sortDirection = SortDirection.Ascending;

            if (sortExpression == "debtor_deadline")
            {
                sortDirection = ViewState["SortDirection"] as SortDirection? ?? SortDirection.Ascending;
                sortDirection = (sortDirection == SortDirection.Ascending) ? SortDirection.Descending : SortDirection.Ascending;
            }
            else
            {
                sortExpression = "debtor_deadline";
                sortDirection = SortDirection.Ascending;
            }


            ViewState["SortExpression"] = sortExpression;
            ViewState["SortDirection"] = sortDirection;

            SortGridViewUtang(sortExpression, sortDirection);
        }


        private void SortGridViewUtang(string sortExpression, SortDirection sortDirection)
        {
            int userID = Convert.ToInt32(((user)Session["user"]).Id);
            List<hutang> dataSource = db.hutang.Where(x => x.user_id == userID).ToList();

            if (sortDirection == SortDirection.Ascending)
            {
                dataSource = dataSource.OrderBy(x => x.debtor_deadline).ToList();
            }
            else
            {
                dataSource = dataSource.OrderByDescending(x => x.debtor_deadline).ToList();
            }
            GridViewUtang.DataSource = dataSource;
            GridViewUtang.DataBind();
        }

        protected void search_TextChanged1(object sender, EventArgs e)
        {
            string keyword = search.Text.Trim();
            int userID = Convert.ToInt32(((user)Session["user"]).Id);
            List<hutang> dataSource = db.hutang.Where(x => x.user_id == userID).ToList();
            dataSource = dataSource.Where(x => x.debtor_name.ToLower().Contains(keyword.ToLower())).ToList();
            GridViewUtang.DataSource = dataSource;
            GridViewUtang.DataBind();
        }
    }
}