﻿<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="InfoNota.aspx.cs" Inherits="NotaQ.View.InfoNota" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head runat="server">
       <title>Info Nota</title>
       <meta charset="UTF-8"/>
       <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
       <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
       <link rel="stylesheet" type="text/css" href="../Content/StyleSheet.css"/>
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
            <a class ="selected" href ="InfoNota.aspx">Info Nota</a>
            <a href ="ItemList.aspx">Pengaturan Produk / Jasa</a>
            <a href ="Pengaturan Penghutang.aspx">Pengaturan Penghutang</a>
        </div>
        <form runat="server" class="info_main_frame">
            <div class ="info_frame">
                <div class ="info_title">
                    <label>Toko Sinar Maju</label>
                    <label>Jl. KH. Wahid Hasyim, RT.002/RW.007, Cipadu, Kec. Larangan, Kota Tangerang, Banten 15155</label>
                    <label>============================================================================</label>
                </div>
            </div>
            <div class ="info_frame">
                <label class ="divide">============================================================================</label>
            </div>
            <div class ="info_frame">
                <div class ="info_top">
                    <label class="info_label">No Nota</label>
                    <label class="info_label">Tanggal Pembelian</label>
                    <label class="info_label">Nama Pembeli</label>
                    <label class="info_label">Dilayani: </label>
                </div>
            </div>
            <div class ="info_frame">
                <label class ="divide">============================================================================</label>
            </div>
            <div class ="info_frame">
                <div class ="info_middle">
                    <label class="info_label">Nama Produk</label>
                    <label class="info_label">Harga Satuan</label>
                </div>
             </div>
            <div class ="info_frame">
                <label class ="divide">============================================================================</label>
            </div>
            <div class ="info_frame">
                <div class ="info_top">
                    <label class="info_label">Total Harga Produk</label>
                    <label class="info_label">Pembayaran</label>
                    <label class="info_label">Hutang</label>
                    <label class="info_label">Batas Pembayaran Hutang</label>
                </div>
            </div>
            <div class ="info_frame">
                <label class ="divide">============================================================================</label>
            </div>
            <div class ="info_frame">
                <input type="text" placeholder="-Catatan Bawah-" class ="info_catatan"/>
            </div>
        </form>
    </body>
</html>
