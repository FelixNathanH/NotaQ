<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="SettingHutang.aspx.cs" Inherits="NotaQ.View.SettingHutang" %>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Pengaturan Penghutang</title>
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
            <a href ="ItemList.aspx">Pengaturan Produk / Jasa</a>
            <a class ="selected" href ="Pengaturan Penghutang.aspx">Pengaturan Penghutang</a>
        </div>
        <div class ="middle_storage_frame">
            <form runat="server" class="debtor_setting">
                <div class="filter">
                    <asp:Button ID="urutkan" runat="server" Text="Urutkan" class ="urutkan"/>
                    <input type="text" placeholder="Cari" class ="search"/>
                </div>
                <div class="debtor_limit">
                    <div class ="debtor_limit_days">
                        <label>Batas Hutang: </label>
                        <input type="text" placeholder="7" class="debtor_input" />
                        <label> Hari</label>
                    </div>
                    <div class ="debtor_limit_reminder">
                        <label>Diingatkan: </label>
                        <input type="text" placeholder="3" class="debtor_input"/>
                        <label> Sebelum Batas</label>
                    </div>
                </div>
                <div class ="debtor_limit_frequency">
                    <label>Frekuensi Pengingat: </label>
                    <input type="text" placeholder="1" class="debtor_input"/>
                    <label> kali setiap  </label>
                    <input type="text" placeholder="1" class="debtor_input"/>
                    <label> hari</label>
                </div>
                <div class="debtor_middle">
                    <div class="debtor_item">
                        <label class="debtor_item_numbering">1</label>
                        <div class="debtor_item_frame">
                            <div class="debtor_item_data">
                                <label>Nama: Andi S</label>
                                <label>Alamat: Jl. Pajak Utama,Jurang Manggu 15155</label>
                                <label>Jumlah Hutang: Rp.20.000</label>
                                <label>Sudah Dibayar: Rp.0</label>
                                <label>Tanggal Pembelian: 5/3/2023</label>
                                <label>Batas Pembayaran Hutang: 12/3/2023</label>
                            </div>
                        </div>
                        <div class="debtor_action">
                            <div class="debtor_logo_pengingat">
                                <iconify-icon icon="mdi:bell-badge" style="color: green;" class ="pengingat"></iconify-icon>
                                <label>Pengingat</label>
                            </div>
                            <div class="debtor_logo_bayar">
                                <iconify-icon icon="ph:money-bold" style="color: red;" class ="bayar"></iconify-icon>
                                <label>Bayar</label>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </body>
</html>