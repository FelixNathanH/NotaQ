using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using notaq.Controller;
using notaq.Models;

namespace notaq.Pages
{
    public partial class Login : System.Web.UI.Page
    {
        private UserController userControl = new UserController();
        private Label loginLabel;
        protected void Page_Load(object sender, EventArgs e)
        {
            loginLabel = login_warn; //Init
            loginLabel.Style.Add("display", "none"); // Hide Warn
        }
        protected void login_Click(object sender, EventArgs e)
        {
            string username = log_username.Text;
            string password = log_password.Text;
            bool isRemember = remember.Checked;

            User user = userControl.UserLogin(username, password);
            if (user != null)
            {
                Session["user"] = user;
                
                if(isRemember)
                {
                    HttpCookie cookie = new HttpCookie("user_cookie");
                    cookie.Value = user.Id;
                    cookie.Expires = DateTime.Now.AddHours(1);
                    Response.Cookies.Add(cookie);
                }

                Response.Redirect("ItemList.aspx");
            }
            else
            {
                loginLabel.Style.Remove("display"); // Show Warn
            }
        }

        protected void gotoRegister_Click(object sender, EventArgs e)
        {
            Response.Redirect("Register.aspx");
        }
    }
}