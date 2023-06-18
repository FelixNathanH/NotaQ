using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using NotaQ.Model;
using NotaQ.Controller;

namespace NotaQ.View
{
    public partial class InformasiAkun : System.Web.UI.Page
    {
        private DatabaseEntities db = new DatabaseEntities();
        protected void Page_Load(object sender, EventArgs e)
        {
            CheckUser();
            DisplayUserData();

            user olduser = (user)Session["user"];
            header_shop.Text = olduser.name;
        }
        private void DisplayUserData()
        {
            if (Session["user"] == null)
                return;
            user olduser = (user)Session["user"];

            info_realName.Text = olduser.name;
            info_email.Text = olduser.email;
            info_phoneNumber.Text = olduser.phone_number;
        }
        protected void logout_Click(object sender, EventArgs e)
        {
            string[] cookies = Request.Cookies.AllKeys;

            foreach (string cookie in cookies)
            {
                Response.Cookies[cookie].Expires = DateTime.Now.AddDays(-1);
            }

            Session.Remove("user");
            Response.Redirect("Login.aspx");
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