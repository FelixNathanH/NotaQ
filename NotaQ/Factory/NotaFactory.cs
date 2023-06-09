using NotaQ.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace NotaQ.Factory
{
    public class NotaFactory
    {
        public nota createNota(int id, string buyerName, string buyerPhoneNumber, DateTime buyDate, int employee_id, int totalPrice, int totalPayment, string paymentMethod)
        {
            nota newNota = new nota();
            newNota.Id = id;
            newNota.buyer_name = buyerName;
            newNota.buyer_phone_number = buyerPhoneNumber;
            newNota.buy_date = buyDate;
            newNota.employee_id = employee_id;
            newNota.total_price = totalPrice;
            newNota.total_payment = totalPayment;
            newNota.payment_method = paymentMethod;
            return newNota;
        }
    }
}