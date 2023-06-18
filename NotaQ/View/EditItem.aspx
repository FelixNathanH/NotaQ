<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="EditItem.aspx.cs" Inherits="NotaQ.View.EditItem" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Insert Item</title>
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

        <%--2nd Header--%> 
        <div class ="second_header">
            <a href ="InfoNota.aspx">Info Nota</a>
            <a class ="selected" href ="ItemList.aspx">Pengaturan Produk / Jasa</a>
            <a href ="SettingHutang.aspx">Pengaturan Penghutang</a>
        </div>
    <form id="form1" runat="server">
        <div class="middle_storage_frame">
            <h1>Update Product</h1>
            <div>
                <asp:Label ID="lbName" runat="server" Text="Nama Product: "></asp:Label>
                <asp:TextBox ID="tbName" runat="server"></asp:TextBox>
            </div>
            <div>
                <asp:Label ID="lbPrice" runat="server" Text="Harga: "></asp:Label>
                <asp:TextBox ID="tbPrice" runat="server"></asp:TextBox>
            </div>
            <div>
                <asp:Label ID="lbStock" runat="server" Text="Stok: "></asp:Label>
                <asp:TextBox ID="tbStock" runat="server"></asp:TextBox>
            </div>
            <div>
                <asp:Label ID="lbDescription" runat="server" Text="Deskripsi: "></asp:Label>
                <asp:TextBox ID="tbDescription" runat="server"></asp:TextBox>
            </div>
            <asp:Button ID="btnUpdate" runat="server" Text="Update Item" OnClick="btnUpdate_Click" />
        </div>
    </form>
</body>
</html>
