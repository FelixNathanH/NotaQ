<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="RegisterPage.aspx.cs" Inherits="NotaQ.View.RegisterPage" %>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head runat="server">
        <title>Register</title>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="../Content/StyleSheet.css"/>
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    </head>
    <body>
        <div class="register_frame">
            <div class ="register_logo">
                <img src="../Asset/NotaQ.png" alt="logo" class ="big_logo"/>
            </div>
            <form runat="server" class="register_form" autocomplete="off">
                <div class="left_profile">
                    <label>Buat Akun Baru</label>
                    <img src="profile.png" alt="logo" class ="profile_logo"/>
                    <div class ="register_button">
                        <asp:Button ID="unggah_foto" runat="server" Text="Unggah Foto Profil" class="unggah_foto"/>
                        <label>+</label>
                    </div>
                    <asp:Button ID="make_account" runat="server" Text="Buat Akun" class="make_account" OnClick="make_account_Click"/>
                     <asp:Button ID="goToLogin" runat="server" Text="Sudah Punya Akun?" class="gotoLogin" OnClick="goToLogin_Click"/>
                </div>
                <div class="right_profile">
                    <div class = "top_label">
                        <label>Nama Anda</label>
                        <asp:Label ID="name_warn" runat="server" class ="warning" Text="* Anda perlu mengisi nama anda"></asp:Label>
                    </div>
                    <asp:TextBox ID="reg_realname" runat="server" placeholder="Contoh: Jojo"/></asp:TextBox>
                    <div class="top_label">
                        <label>Email Pengguna</label>
                        <asp:Label ID="email_warn" runat="server" class ="warning" Text="* Anda perlu mengisi email di kolom ini"></asp:Label>
                    </div>
                    <asp:TextBox ID="reg_email" runat="server" placeholder="Contoh: jojo@gmail.com"/></asp:TextBox>
                   <div class ="top_label">
                       <label>Nomor Telepon</label>
                       <asp:Label ID="phone_warn" runat="server" class ="warning" Text="* Tidak boleh kosong dan hanya menerima angka"></asp:Label>
                    </div>
                    <asp:TextBox ID="reg_phonenumber" runat="server" placeholder="Contoh: 081234567890"/></asp:TextBox>
                    <div class ="top_label">
                        <label>Kata Sandi</label>
                        <asp:Label ID="pass_warn" runat="server" class ="warning" Text="* Anda perlu membuat password untuk akun anda"></asp:Label>
                    </div>
                    <asp:TextBox ID="reg_password" runat="server" placeholder="********" TextMode="Password" class ="password"/></asp:TextBox>
                </div>
            </form>
        </div>
    </body>
</html>