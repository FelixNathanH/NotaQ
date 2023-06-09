using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace NotaQ.View
{
    public partial class MakeNota : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (!IsPostBack)
            {
                // Mengambil nilai dari variabel sesi
                string produk = (string)Session["produk"];
                string jumlah = (string)Session["jumlah"];

                // Mengatur nilai input di halaman
                produkInput.Value = produk;
                jumlahInput.Value = jumlah;
            }
        }

        protected void tambah_produk_Click(object sender, EventArgs e)
        {
            string produk = Request.Form["produk"];
            string jumlah = Request.Form["jumlah"];

            // Menyimpan nilai di variabel sesi
            Session["produk"] = produk;
            Session["jumlah"] = jumlah;
        }

        protected void kirim_nota_Click(object sender, EventArgs e)
        {
            Whatsapp.Twilio.SendMessage();
        }

    }
}