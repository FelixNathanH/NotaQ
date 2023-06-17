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
    public partial class Register : System.Web.UI.Page
    {
        private UserController userControl = new UserController();
        private List<Label> errorLabels = new List<Label>();
        protected void Page_Load(object sender, EventArgs e)
        {
            InitializeError();
            HideError();
        }
        private void InitializeError()
        {
            errorLabels.Add(name_warn);
            errorLabels.Add(shop_warn);
            errorLabels.Add(user_warn);
            errorLabels.Add(phone_warn);
            errorLabels.Add(pass_warn);
        }
        private void HideError()
        {
            for (int i = 0; i < errorLabels.Count; i++)
                errorLabels[i].Style.Add("display", "none");
        }
        private void ShowError(List<int> errors)
        {
            for (int i = 0; i < errors.Count; i++)
                errorLabels[errors[i]].Style.Remove("display");
        }
        protected void make_account_Click(object sender, EventArgs e)
        {
            String realName = reg_realname.Text;
            String shopName = reg_shopname.Text;
            String userName = reg_username.Text;
            String phoneNumber = reg_phonenumber.Text;
            String password = reg_password.Text;

            var checker = userControl.UserRegister(realName, shopName, userName, phoneNumber, password);
            User user = checker.Item1;
            if (user != null)
            {
                Session["user"] = user;
                Response.Redirect("ItemList.aspx");
            }
            else
            {
                HideError();
                ShowError(checker.Item2);
            }
        }

        protected void goToLogin_Click(object sender, EventArgs e)
        {
            Response.Redirect("Login.aspx");
        }
    }
}