<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="SettingHutang.aspx.cs" Inherits="NotaQ.View.SettingHutang" %>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <style>
            .gridviewList {
                 margin-top: 20px;
             }

            #GridViewUtang {
              width: 100%;
              border-collapse: collapse;
              border: 1px solid #ddd;
            }

            #GridViewUtang th,
            #GridViewUtang td {
              padding: 8px;
              border: 1px solid #ddd;
            }

            #GridViewUtang th {
              background-color: #f2f2f2;
              font-weight: bold;
              text-align: left;
            }

            #GridViewUtang tr {
              background-color: white;
            }

            .debtor_logo_pengingat,
            .debtor_logo_bayar {
              display: flex;
              align-items: center;
            }

            .debtor_logo_pengingat:hover,
            .debtor_logo_bayar:hover {
              background-color:lightgrey;
            }

            .pengingat,
            .bayar {
              margin-right: 5px;
            }

            .editButton,
            .deleteButton {
              text-decoration: none;
              color: #333;
              font-weight: bold;
            }

            .editButton:hover,
            .deleteButton:hover {
              text-decoration: underline;
            }

        </style>

        <title>Pengaturan Penghutang</title>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="../Content/StyleSheet.css"/>
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    </head>
    <body>

        <%--Header--%> 
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
            <a href ="ItemList.aspx">Pengaturan Produk / Jasa</a>
            <a class ="selected" href ="SettingHutang.aspx">Pengaturan Penghutang</a>
        </div>

        <%--Content--%> 
        <div class ="middle_storage_frame">
            <form runat="server" class="debtor_setting">

                <%--Filter--%> 
                <div class="filter">
                    <asp:Button ID="urutkan" runat="server" Text="Urutkan" class ="urutkan" OnClick="urutkan_Click"/>
                    <%--<input type="text" placeholder="Cari" class ="search"/>--%>
                    <asp:TextBox ID="search" runat="server" Text="Cari" class="search" OnTextChanged="search_TextChanged1" AutoPostBack="True"></asp:TextBox>
                </div>

                <%--Limit Utang--%> 
                <div class="debtor_limit">
                    <div class ="debtor_limit_days">
                        <label>Batas Hutang:  </label>
                        <asp:TextBox ID="batasutang" runat="server" Text="7" class="debtor_input"></asp:TextBox>
                        <label> Hari</label>
                    </div>
                </div>

                <%--Frekuensi limit--%> 
                <div class ="debtor_limit_frequency">
                    <label>Frekuensi Pengingat: </label>
                    <asp:TextBox ID="frekuensipengingat" runat="server" Text="1" class="debtor_input"></asp:TextBox>
                    <label> kali </label>
                </div>

                <%--Grid--%>
                <div class="gridviewList">
                    <asp:GridView ID="GridViewUtang" runat="server" AutoGenerateColumns="False" OnRowEditing="GridViewUtang_RowEditing" OnRowDeleting="GridViewUtang_RowDeleting" >
                    <Columns>
                        <asp:BoundField DataField="Id" HeaderText="ID" SortExpression="Id" />
                        <asp:BoundField DataField="debtor_name" HeaderText="Name" SortExpression="debtor_name" />
                        <asp:BoundField DataField="debtor_address" HeaderText="Address" SortExpression="debtor_address" />
                        <asp:BoundField DataField="debt_total" HeaderText="Jumlah Utang" SortExpression="debt_total" />
                        <asp:BoundField DataField="debtor_deadline" HeaderText="Batas Pembayaran Utang" SortExpression="debtor_deadline" />
                        <%--<asp:BoundField DataField="debt_reminder_frequency" HeaderText="Jumlah Utang" SortExpression="debt_reminder_frequency" />--%>
                       
                        <%--<asp:CommandField HeaderText="ACTION" ShowDeleteButton="True" ShowEditButton="True" ShowHeader="True" DeleteText="Bayar" EditText="Pengigat"/>--%>

                         <asp:TemplateField HeaderText="ACTION">
                            <ItemTemplate>
                                     <div class="debtor_logo_pengingat">
                                         <iconify-icon icon="mdi:bell-badge" style="color: green;" class ="pengingat"></iconify-icon>
                                         <asp:LinkButton ID="btnEdit" runat="server" CommandName="Edit" Text="Pengingat" CssClass="editButton" Font-Underline="false" Font-Size="Large"/>
                                    </div>

                                     <div class="debtor_logo_bayar">
                                         <iconify-icon icon="ph:money-bold" style="color: red;" class ="bayar"></iconify-icon>
                                         <asp:LinkButton ID="btnDelete" runat="server" CommandName="Delete" Text="Bayar" CssClass="deleteButton" Font-Underline="false" Font-Size="Large"/>
                                    </div>
                            </ItemTemplate>
                        </asp:TemplateField>

                    </Columns>  
                </asp:GridView>
               </div>
            </form>
        </div>
    </body>
</html>