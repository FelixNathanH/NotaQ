<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="ItemList.aspx.cs" Inherits="NotaQ.View.ItemList" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Item List</title>
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
                <asp:Label ID="header_shop" runat="server" Text="Label" class="shop_header"></asp:Label>
            </div>
        </div>
        <div class ="second_header">
            <a href ="InfoNota.aspx">Info Nota</a>
            <a class ="selected" href ="ItemList.aspx">Pengaturan Produk / Jasa</a>
            <a href ="SettingHutang.aspx">Pengaturan Penghutang</a>
            <a href ="InformasiAkun.aspx">Informasi Akun</a>
        </div>
        <div class ="middle_storage_frame">
             <form runat="server" class="product_setting">
                <div class="filter">
                    <asp:Button ID="urutkan" runat="server" Text="Urutkan Berdasarkan Nama" class ="urutkanItem" OnClick="urutkan_Click"/>
                    <asp:TextBox ID="search" runat="server" placeholder="Cari" class="searchItem" OnTextChanged="search_TextChanged1" AutoPostBack="True"></asp:TextBox>
                </div>
                <div class="gridviewList">
                    <asp:GridView ID="GridView1" runat="server" AutoGenerateColumns="False" OnRowDeleting="GridView1_RowDeleting" OnRowEditing="GridView1_RowEditing">
                        <Columns>
                            <asp:BoundField DataField="Id" HeaderText="ID" SortExpression="Id" />
                            <asp:BoundField DataField="product_name" HeaderText="Nama" SortExpression="product_name" />
                            <asp:BoundField DataField="product_price" HeaderText="Harga" SortExpression="product_price" />
                            <asp:BoundField DataField="product_stock" HeaderText="Stok" SortExpression="product_stock" />
                            <asp:BoundField DataField="product_description" HeaderText="Deskripsi Produk" SortExpression="product_description" /> 

                            <asp:TemplateField HeaderText="ACTION">
                                <ItemTemplate>
                                    <div class="editItem">
                                         <iconify-icon icon="material-symbols:edit" class="editt"></iconify-icon>
                                         <asp:LinkButton ID="btnEdit" runat="server" CommandName="Edit" Text="Edit" CssClass="editButton" Font-Underline="false" Font-Size="Large"/>
                                    </div>
                                    <div class="delItem">
                                         <iconify-icon icon="material-symbols:delete" class="deletee"></iconify-icon>
                                         <asp:LinkButton ID="btnDelete" runat="server" CommandName="Delete" Text="Delete" CssClass="deleteButton" Font-Underline="false" Font-Size="Large"/>
                                    </div>
                                </ItemTemplate>
                            </asp:TemplateField>
                        </Columns>  
                    </asp:GridView>
                 </div>
                 <div class ="ItemList_tambahProduk_frame">
                     <label>+</label>
                     <asp:Button ID="tambah_produk" runat="server" Text="Tambah Produk / Jasa" class ="ItemList_tambahProduk_button" OnClick="tambah_produk_Click"/>
                 </div>
            </form>
        </div>
    </body>
</html>
