using System;
using System.Collections.Generic;
using System.Web.UI.WebControls;

namespace NotaQ.View
{
    [Serializable]
    public class Produk
    {
        public int Id { get; set; }
        public string Nama { get; set; }
        public int Jumlah { get; set; }
    }

    public partial class MakeNota : System.Web.UI.Page
    {
        List<Produk> produkList = new List<Produk>();

        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void DeleteLinkBtn_Click(object sender, EventArgs e)
        {

        }

        protected void tambah_produk_Click(object sender, EventArgs e)
        {

        }
    }
}
