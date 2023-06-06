using NotaQ.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace NotaQ.Factory
{
    public class NotaDetailFactory
    {
        public nota_detail CreateNotaDetail(int id, int nota_id, int product_id, string product_name, int product_price)
        {
            nota_detail newNotaDetail = new nota_detail();
            newNotaDetail.Id = id;
            newNotaDetail.nota_id = nota_id;
            newNotaDetail.product_id = product_id;
            newNotaDetail.product_name = product_name;
            newNotaDetail.product_price = product_price;
            return newNotaDetail;
        }
    }
}