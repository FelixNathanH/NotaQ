<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="InsertItem.aspx.cs" Inherits="NotaQ.View.InsertItem" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
     <style>
        body {
            font-family: 'Trebuchet MS';
            margin: 0;
        }  
        h1 {
            font-size: 44px;
            margin-bottom: 25px;
            text-align:center;
        }
        .insertLbl {
            margin-top:10px;
            margin-bottom: 20px;
            padding-left: 50px;
            padding-right: 50px;
            font-size: 24px;
        }
        .insertLbl label {
            display: block;
            margin-top: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 20px;
        }
        .insertLbl input[type="text"] {
            width: 100%;
            margin-top:5px;
            height: 30px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .insertFrame{
             margin-top: 20px;
             display:block;
             margin-left: 50px;
         }
        .insertBtn {
            display: flex;
            font-family: 'Trebuchet MS';
            font-size: 20px;
            font-weight: bold;
            width: auto;
            padding: 8px 8px 8px 8px;
            background-color: #D1D1D1;
            border-radius: 6px;
            border: solid;
        }

        .insertBtn:hover {
            background-color: #a0a0a0;
            cursor: pointer;
        }
    </style>
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
                <img src="../Asset/NotaQ.png" alt="logo" class ="big_logo"/>
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
            <h1>Insert Product</h1>
            <div class="insertLbl">
                <asp:Label ID="lbName" runat="server" Text="Name: "></asp:Label>
                <asp:TextBox ID="tbName" runat="server"></asp:TextBox>
            </div>
            <div class="insertLbl">
                <asp:Label ID="lbPrice" runat="server" Text="Price: "></asp:Label>
                <asp:TextBox ID="tbPrice" runat="server"></asp:TextBox>
            </div>
            <div class="insertLbl">
                <asp:Label ID="lbStock" runat="server" Text="Stock: "></asp:Label>
                <asp:TextBox ID="tbStock" runat="server"></asp:TextBox>
            </div>
            <div class="insertLbl">
                <asp:Label ID="lbDescription" runat="server" Text="Description: "></asp:Label>
                <asp:TextBox ID="tbDescription" runat="server"></asp:TextBox>
            </div>
            <div class="insertFrame">
                <asp:Button ID="btnAdd" runat="server" Text="Add Product" OnClick="btnAdd_Click" class="insertBtn"/>
            </div>
        </div>
    </form>
</body>
</html>
