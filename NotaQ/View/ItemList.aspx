<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="ItemList.aspx.cs" Inherits="NotaQ.View.ItemList" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <style>
            .product_setting {
    display: flex;
    flex-direction: column;
    padding: 3% 15%;
}

.produk_outside {
    display: flex;
    margin-top: 20px;
}

.produk_inside {
    background-color: white;
    width: 600px;
    height: 90px;
    border-radius: 4px;
    display: flex;
    flex-direction: column;
    padding: 2.5% 4%;
}

    .produk_inside label {
        font-family: 'Trebuchet MS';
        font-size: 20px;
        font-weight: bold;
    }

.urutkanItem {
    font-family: 'Trebuchet MS';
    font-size: 20px;
    font-weight: bold;
    text-align: left;
    width: auto;
    padding: 8px 8px 8px 8px;
    background-color: #D1D1D1;
    border-radius: 6px;
    margin: 8px 0;
    border: solid;
}

    .urutkanItem:hover {
        background-color: #a0a0a0;
        cursor: pointer;
    }

.searchItem {
    font-family: 'Trebuchet MS';
    font-size: 20px;
    font-weight: bold;
    text-align: left;
    width: 40%;
    padding: 8px 8px 8px 8px;
    background-color: white;
    border-radius: 6px;
    margin: 8px 0;
    border: solid;
}

    .searchItem::placeholder {
        font-family: 'Trebuchet MS';
        font-size: 20px;
        color: gray;
    }

.ItemList_tambahProduk_frame {
    height: 45px;
    display: flex;
    width: 50%;
    margin-top: 20px;
    background-color: #D1D1D1;
    color: white;
    font-size: 48px;
    align-items: center;
    vertical-align: middle;
    padding: 0% 20px;
}

.ItemList_tambahProduk_button {
    font-family: 'Trebuchet MS';
    text-align: left;
    font-size: 24px;
    color: white;
    background-color: #D1D1D1;
    padding-left: 20px;
}

.gridviewList {
    margin-top: 20px;
}

#GridView1 {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ddd;
}

    #GridView1 th,
    #GridView1 td {
        padding: 8px;
        border: 1px solid #ddd;
    }

    #GridView1 th {
        background-color: #f2f2f2;
        font-weight: bold;
        text-align: left;
    }

    #GridView1 tr {
        background-color: white;
    }

.editItem,
.deleteItem {
    display: flex;
    align-items: center;
}

    .editItem:hover,
    .delItem:hover {
        background-color: lightgrey;
    }

.editt,
.deletee {
    margin-right: 5px;
}

.editButton,
.deleteButton {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}
        </style>
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
                <img src="../Asset/NotaQ.png" alt="logo" class ="big_logo"/>
            </div>
            <div class ="header_middle">
                <a href ="MakeNota.aspx">Buat Nota</a>
                <a class ="selected" href ="ItemList.aspx">Pengaturan</a>
            </div>
            <div class ="header_right">
                <img src="images/logo.svg" alt="logo" class ="header_right_logo"/>
                <a>Toko NotaQ</a>
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
