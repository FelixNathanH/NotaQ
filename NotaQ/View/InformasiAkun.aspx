<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="InformasiAkun.aspx.cs" Inherits="NotaQ.View.InformasiAkun" %>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Informasi Akun</title>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="../Content/StyleSheet.css"/>
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    </head>
    <body>
       <div class ="header">
            <div class="header_left">
                <img src="../Asset/NotaQ.png" alt="logo" class ="big_logo"/>
            </div>
            <div class ="header_middle">
                <a href ="MakeNota.aspx">Buat Nota</a>
                <a class ="selected" href ="ItemList.aspx">Pengaturan</a>
            </div>
            <div class ="header_right">
                <img src="images/logo.svg" alt="logo" class ="header_right_logo"/>
                <asp:Label ID="header_shop" runat="server" Text="Label" class="shop_header"></asp:Label>
            </div>
        </div>
        <div class ="second_header">
            <a href ="InfoNota.aspx">Info Nota</a>
            <a href ="ItemList.aspx">Pengaturan Produk / Jasa</a>
            <a href ="SettingHutang.aspx">Pengaturan Penghutang</a>
            <a class ="selected" href ="InformasiAkun.aspx">Informasi Akun</a>
        </div>
        <div class ="account_frame">
            <form runat="server" class="account_setting">
                <div class="left_account">
                    <img src="profile.png" alt="logo" class ="profile_logo"/>
                    <div class ="register_button">
                        <asp:Button ID="unggah_foto" runat="server" Text="Unggah Foto Profil" class="unggah_foto"/>
                        <label>+</label>
                    </div>
                </div>
                <div class="right_account">
                    <label class="account_label">Nama Anda</label>
                    <asp:Label ID="info_realName" runat="server" Text="Joni" class="account_info"></asp:Label>
                    <label class="account_label">Email Anda</label>
                    <asp:Label ID="info_email" runat="server" Text="Joni Shop" class="account_info"></asp:Label>
                    <label class="account_label">Nomor Telepon Anda</label>
                    <asp:Label ID="info_phoneNumber" runat="server" Text="081234567890" class="account_info"></asp:Label>
                    <asp:Button ID="logout" runat="server" Text="Logout" OnClick="logout_Click" class="logout_button"/>
                </div>
            </form>
        </div>
    </body>
</html>
