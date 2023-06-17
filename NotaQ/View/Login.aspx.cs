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
            string email = log_email.Text;
            string password = log_password.Text;
            bool isRemember = remember.Checked;

            user olduser = userControl.UserLogin(email, password);
            if (olduser != null)
            {
                Session["user"] = olduser;

                if (isRemember)
                {
                    HttpCookie cookie = new HttpCookie("user_cookie");
                    cookie.Value = olduser.Id.ToString();
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
            Response.Redirect("RegisterPage.aspx");
        }
    }
}