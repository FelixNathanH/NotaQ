using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using NotaQ.Model;

namespace NotaQ.View
{
    public partial class InfoNota : System.Web.UI.Page
    {
        private DatabaseEntities db = new DatabaseEntities();
        protected void Page_Load(object sender, EventArgs e)
        {
            CheckUser();
            user olduser = (user)Session["user"];
            header_shop.Text = olduser.name;
        }
        private void CheckUser()
        {
            if (Session["user"] == null && Request.Cookies["user_cookie"] == null)
            {
                Response.Redirect("Login.aspx");
            }
            else
            {
                user olduser;
                if (Session["user"] == null)
                {
                    var id = Request.Cookies["user_cookie"].Value;
                    olduser = (from x in db.user where x.Id == int.Parse(id) select x).FirstOrDefault();
                    Session["user"] = olduser;
                }
                else
                {
                    olduser = (user)Session["user"];
                }
            }
        }
    }
}