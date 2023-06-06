<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="ItemList.aspx.cs" Inherits="NotaQ.View.ItemList" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Item List</title>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="Content/StyleSheet.css"/>
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    </head>
    <body>
       <div class ="header">
            <div class="header_left">
                <img src="NotaQ.png" alt="logo" class ="header_left_logo" />
            </div>
            <div class ="header_middle">
                <a href ="MakeNota.aspx">Buat Nota</a>
                <a class ="selected" href ="ItemList.aspx">Pengaturan</a>
            </div>
            <div class ="header_right">
                <img src="images/logo.svg" alt="logo" class ="header_right_logo"/>
                <a>Sinar Maju</a>
            </div>
        </div>
        <div class ="second_header">
            <a href ="InfoNota.aspx">Info Nota</a>
            <a class ="selected" href ="ItemList.aspx">Pengaturan Produk / Jasa</a>
            <a href ="Pengaturan Penghutang.aspx">Pengaturan Penghutang</a>
        </div>
        <div class ="middle_storage_frame">
             <form runat="server" class="product_setting">
                <div class="filter">
                    <asp:Button ID="urutkan" runat="server" Text="Urutkan" class ="urutkan"/>
                    <input type="text" placeholder="Cari" class ="search"/>
                </div>
                 <div class="produk_outside">
                     <div class="produk_inside">
                         <label>Produk A</label>
                         <label>Harga: Rp.7000</label>
                     </div>
                     <iconify-icon icon="ph:trash-bold" style="color: white;"class ="trash"></iconify-icon>
                 </div>
                 <div class="produk_outside">
                     <div class="produk_inside">
                         <label>Produk B</label>
                         <label>Harga: Rp.10000</label>
                     </div>
                     <iconify-icon icon="ph:trash-bold" style="color: white;" class ="trash"></iconify-icon>
                 </div>
                 <div class="produk_outside">
                     <div class="produk_inside">
                         <label>Produk C</label>
                         <label>Harga: Rp.12000</label>
                     </div>
                     <iconify-icon icon="ph:trash-bold" style="color: white;"class ="trash"></iconify-icon>
                 </div>
                 <div class ="ItemList_tambahProduk_frame">
                     <label>+</label>
                     <asp:Button ID="tambah_produk" runat="server" Text="Tambah Produk / Jasa" class ="ItemList_tambahProduk_button"/>
                 </div>
            </form>
        </div>
    </body>
</html>