using NotaQ.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace NotaQ.Factory
{
    public class NotaDetailFactory
    {
        public static nota_detail createNotaDetail(int nota_id, int product_id, string product_name, int product_price, int product_quantity)
        {
            nota_detail newNotaDetail = new nota_detail();
            newNotaDetail.nota_id = nota_id;
            newNotaDetail.product_id = product_id;
            newNotaDetail.product_name = product_name;
            newNotaDetail.product_price = product_price;
            newNotaDetail.product_quantity = product_quantity;
            return newNotaDetail;
        }
    }
}