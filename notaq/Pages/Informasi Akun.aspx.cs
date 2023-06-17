using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using notaq.Models;

namespace notaq.Pages
{
    public partial class Informasi_Akun : System.Web.UI.Page
    {
        private AccountEntities db = new AccountEntities();
        protected void Page_Load(object sender, EventArgs e)
        {
            CheckUser();
            DisplayUserData();

            User user = (User)Session["user"];
            header_shop.Text = user.shopname;
        }
        private void DisplayUserData()
        {
            if (Session["user"] == null)
                return;
            User user = (User)Session["user"];

            info_realName.Text = user.realname;
            info_shopName.Text = user.shopname;
            info_userName.Text = user.username;
            info_phoneNumber.Text = user.phonenumber;
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