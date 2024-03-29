﻿<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="MakeNota.aspx.cs" Inherits="NotaQ.View.MakeNota" %>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Make Nota</title>
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
                <a href ="MakeNota.aspx" class ="selected">Buat Nota</a>
                <a href ="ItemList.aspx">Pengaturan</a>
            </div>
            <div class ="header_right">
                <img src="images/logo.svg" alt="logo" class ="header_right_logo"/>
                <asp:Label ID="namaToko" runat="server"></asp:Label>
            </div>
        </div>
        <div class="MakeNota_middle_frame">
            <form runat="server" class="MakeNota_middle_item">
                <!--Informasi Nota & Pembeli -->
                <label>Tanggal Pembelian :</label>
                <asp:TextBox ID="buyDate" runat="server" placeholder="Tanggal Beli"></asp:TextBox>

                <label>Nama Pembeli :</label>
                <asp:Label ID="errorBuyer" class="errorLabel" runat="server" Text="" ></asp:Label>
                <asp:TextBox ID="buyer" runat="server" placeholder="Nama Pembeli"></asp:TextBox>

                <label>Nomor Telepon Pembeli :</label>
                <asp:Label ID="errorPhn" class="errorLabel" runat="server" Text=""></asp:Label>
                <asp:TextBox ID="buyerPhone" runat="server" placeholder="Nomor Pembeli"></asp:TextBox>

                <label>Dilayani Oleh :</label>
                <asp:TextBox ID="buyerAssistant" runat="server" placeholder="pelayan"></asp:TextBox>

                <!--Display produk yang dibeli / dipilih-->
                <label>Produk Dibeli :</label>
                <asp:Label ID="errorProduct" class="errorLabel" runat="server" Text=""></asp:Label>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: left;">Nama Produk</th>
                            <th scope="col" style="text-align: left;">Harga Produk</th>
                            <th scope="col" style="text-align: left;">Jumlah Dibeli</th>
                            <th scope="col" style="text-align: left;">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <asp:Repeater ID="TableRepeater" runat="server">
                            <ItemTemplate>
                                <tr>
                                    <td scope="row"><%# Eval("cart_product_name") %></td>
                                    <td scope="row"><%# Eval("cart_product_price") %></td>
                                    <td scope="row"><%# Eval("cart_product_quantity") %></td>
                                    <td scope="row">
                                        <asp:LinkButton ID="DeleteLinkBtn" runat="server" onclick="DeleteLinkBtn_Click" CommandArgument='<%#Eval("Id") %>' class="btn btn-outline-danger"  > 
                                            <img src="../Asset/trash_icon.png" alt="Trash Icon" style="width: 25px; height: 25px;" />
                                        </asp:LinkButton>
                                    </td>
                                </tr>
                            </ItemTemplate>
                        </asp:Repeater>
                    </tbody>
                </table>


                <!--Fungsi untuk search produk-->
                <asp:Label ID="errorFound" class="errorLabel" runat="server" Text=""></asp:Label>
                <asp:TextBox ID="productNameSearch" runat="server" placeholder="Masukan Nama Produk" ></asp:TextBox>
                <asp:Button ID="search_product" runat="server" Text="Cek Produk" onclick="search_product_Click"/>

                <!--Tabel produk dengan nama mirip -->
                 <asp:GridView ID="GridViewCart" runat="server" AutoGenerateColumns="False" CssClass="gridview_makenota">
                    <Columns>
                        <asp:BoundField DataField="product_name" HeaderText="Produk" ItemStyle-CssClass="gridview-column_makenota" />
                        <asp:BoundField DataField="product_price" HeaderText="Harga" ItemStyle-CssClass="gridview-column_makenota" />
                        <asp:BoundField DataField="product_stock" HeaderText="Stok" ItemStyle-CssClass="gridview-column_makenota" />
                    </Columns>
                </asp:GridView>

                <!--Informasi Produk -->
                <asp:Label ID="errorName" class="errorLabel" runat="server" Text=""></asp:Label>
                <asp:TextBox ID="Productname" runat="server" placeholder="Nama Produk" ></asp:TextBox>

                <asp:Label ID="errorPrice" class="errorLabel" runat="server" Text=""></asp:Label>
                <asp:TextBox ID="productPrice" runat="server" placeholder="Harga Produk" ></asp:TextBox>

                <asp:Label ID="errorQuantity" class="errorLabel" runat="server" Text=""></asp:Label>
                <asp:TextBox ID="productQuantity" runat="server" placeholder="Jumlah Produk" ></asp:TextBox>
                <asp:Button ID="tambah_produk" runat="server" Text="Tambah Produk" onclick="tambah_produk_Click" class="MakeNota_tambahProduk_button" />

                <!--Label SUM harga -->
                <asp:Label class ="MakeNota_total_harga" ID="totalLbl" runat="server" Text="Rp."></asp:Label>
                
                <!--Metode Pembayaran & jumlah dibayar -->
                <label>Pembayaran Dipilih :</label>
                <select name="pembayaran" class="MakeNota_pembayaran">
                    <option value="tunai">Tunai</option>
                    <option value="debit">Debit</option>
                    <option value="emoney">E-Money</option>
                </select>

                <label>Dibayar :</label>
                <asp:Label ID="errorPayment" runat="server" Text=""></asp:Label>
                <asp:TextBox ID="payment" runat="server" placeholder="Rp.--  (Masukan Angka Saja)" ></asp:TextBox>

                 <!--Buat nota -->
                <asp:Label ID="errorExists" runat="server" Text=""></asp:Label>
                <asp:Button ID="kirim_nota" runat="server" Text="Kirim Nota" class="MakeNota_kirimNota_button" OnClick="kirim_nota_Click"/>
            </form>
        </div>
    </body>
</html>
