<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Login.aspx.cs" Inherits="notaq.Pages.Login" %>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head runat="server">
        <title>Login</title>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="Style.css"/>
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    </head>
    <body>
        <div class="register_frame">
            <div class ="register_logo">
                <img src="NotaQ.png" alt="logo" class ="big_logo"/>
            </div>
            <form runat="server" class="login_form_frame" autocomplete="off">
                <div class ="login_form">
                    <div class="top_label">
                        <label>Username Pengguna</label>
                        <asp:Label ID="login_warn" runat="server" class ="warning" Text="* Username atau Password yang dimasukkan tidak tepat"></asp:Label>
                    </div>
                    <asp:TextBox ID="log_username" runat="server"/>
                    <label>Kata Sandi</label>
                    <asp:TextBox ID="log_password" runat="server" TextMode="Password" class ="password_login"/>
                    <div class ="login_buttons">
                        <asp:Button ID="login_account" runat="server" Text="Login" class="login_account" OnClick="login_Click"/>
                        <asp:Button ID="gotoRegister" runat="server" Text="Register" class="login_account" OnClick="gotoRegister_Click"/>
                    </div>
                    <div class ="remember_me">
                        <label>Remember Me</label>
                        <asp:CheckBox ID="remember" runat="server"/>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>

