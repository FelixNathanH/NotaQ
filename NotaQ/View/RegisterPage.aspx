<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="RegisterPage.aspx.cs" Inherits="NotaQ.View.RegisterPage" %>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head runat="server">
        <title>Register</title>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="Content/StyleSheet.css"/>
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    </head>
    <body>
        <div class="register_frame">
            <div class ="register_logo">
                <img src="NotaQ.png" alt="logo" class ="big_logo"/>
            </div>
            <form runat="server" class="register_form">
                <div class="left_profile">
                    <label>Buat Akun Baru</label>
                    <img src="images/logo.svg" alt="logo" class ="profile_logo"/>
                    <div class ="register_button">
                        <asp:Button ID="unggah_foto" runat="server" Text="Unggah Foto Profil" class="unggah_foto"/>
                        <label>+</label>
                    </div>
                    <asp:Button ID="make_account" runat="server" Text="Buat Akun" class="make_account"/>
                </div>
                <div class="right_profile">
                    <label>Nama Anda</label>
                    <input type="text" placeholder="Contoh: Jojo Lili Bibi" />
                    <label>Nama Toko/Jasa Anda</label>
                    <input type="text" placeholder="Contoh: Toko Sinar Maju / Laundry Rizky" />
                    <label>Nomor Pengguna</label>
                    <input type="text" placeholder="Contoh: sinarmaju_bgr / rzk_laundry" />
                    <label>Nomor Telepon</label>
                    <input type="text" placeholder="Contoh: 081234567890" />
                    <label>Kata Sandi</label>
                    <input type="text" placeholder="*********" />
                </div>
            </form>
        </div>
    </body>
</html>