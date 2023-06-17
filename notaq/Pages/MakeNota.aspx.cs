using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using notaq.Models;

namespace notaq.Pages
{
    public partial class MakeNota : System.Web.UI.Page
    {
        private AccountEntities db = new AccountEntities();
        protected void Page_Load(object sender, EventArgs e)
        {
            CheckUser();
            User user = (User)Session["user"];
            header_shop.Text = user.shopname;
        }
        private void CheckUser()
        {
            if (Session["user"] == null && Request.Cookies["user_cookie"] == null)
            {
                Response.Redirect("Login.aspx");
            }
            else
            {
                User user;
                if (Session["user"] == null)
                {
                    var id = Request.Cookies["user_cookie"].Value;
                    user = (from x in db.Users where x.Id == id select x).FirstOrDefault();
                    Session["user"] = user;
                }
                else
                {
                    user = (User)Session["user"];
                }
            }
        }
    }
}