﻿<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="MakeNota.aspx.cs" Inherits="notaq.Pages.MakeNota" %>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Make Nota</title>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="Style.css"/>
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    </head>
    <body>
          <div class ="header">
            <div class="header_left">
                <img src="NotaQ.png" alt="logo" class ="header_left_logo" />
            </div>
            <div class ="header_middle">
                <a href ="MakeNota.aspx" class ="selected">Buat Nota</a>
                <a href ="ItemList.aspx">Pengaturan</a>
            </div>
            <div class ="header_right">
                <img src="images/logo.svg" alt="logo" class ="header_right_logo"/>
                <asp:Label ID="header_shop" runat="server" Text="Label" class="shop_header"></asp:Label>
            </div>
        </div>
        <div class="MakeNota_middle_frame">
            <form runat="server" class="MakeNota_middle_item">
                <label>Tanggal Pembelian :</label>
                <input type="text" placeholder="15 Maret 2023" />
                <label>Nama Pembeli :</label>
                <input type="text" placeholder="Nama Pembeli" />
                <label>Nomor Telepon Pembeli :</label>
                <input type="text" placeholder="081234567890" />
                <label>Alamat Pembeli :</label>
                <input type="text" placeholder="Alamat Pembeli" />
                <label>Dilayani Oleh :</label>
                <input type="text" placeholder="Karyawan X" />
                <label>Produk Dibeli :</label>
                <input type="text" placeholder="Produk 1" />
                <input type="text" placeholder="Jumlah Produk 1" />
                <!-- Produk Lain -->
                <input type="text" placeholder="Produk 2" />
                <input type="text" placeholder="Jumlah Produk 2" />
                <div class ="MakeNota_tambahProduk_frame">
                    <label>+</label>
                    <asp:Button ID="tambah_produk" runat="server" Text="Tambah Produk" class="MakeNota_tambahProduk_button"/>
                </div>
                <label class ="MakeNota_total_harga">Total Harga: Rp.-</label>
                <!-- Kasih Box disini -->
                <label>Pembayaran Dipilih :</label>
                <select id="pembayaran" class="MakeNota_pembayaran">
                    <option value="tunai">Tunai</option>
                    <option value="debit">Debit</option>
                    <option value="emoney">E-Money</option>
                </select>
                <div class="MakeNota_lunas">
                    <label>Lunas</label>
                    <asp:CheckBox ID="lunas_box" runat="server" />
                </div>
                <label>Dibayar :</label>
                <input type="text" placeholder="Rp.-" />
                <div class ="MakeNota_kirimNota_frame">
                    <asp:Button ID="kirim_nota" runat="server" Text="Kirim Nota" class="MakeNota_kirimNota_button"/>
                </div>
            </form>
        </div>
    </body>
</html>