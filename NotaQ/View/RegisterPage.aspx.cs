using NotaQ.Controller;
using NotaQ.Model;
using System;
using System.Collections.Generic;
using System.Web.UI.WebControls;

namespace NotaQ.View
{
    public partial class RegisterPage : System.Web.UI.Page
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
            errorLabels.Add(email_warn);
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
            string email = reg_email.Text;
            String phoneNumber = reg_phonenumber.Text;
            String password = reg_password.Text;

            var checker = userControl.UserRegister(realName, email, phoneNumber, password);
            user newuser = checker.Item1;
            if (newuser != null)
            {
                Session["user"] = newuser;
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