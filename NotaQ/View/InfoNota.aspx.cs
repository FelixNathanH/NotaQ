using NotaQ.Model;
using System;

namespace NotaQ.View
{
    public partial class InfoNota : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            user olduser = Session["user"] as user;
            if (olduser == null)
            {
                Response.Redirect("Login.aspx");
            }
        }
    }
}