using NotaQ.Model;
using System;

namespace NotaQ.Factory
{
    public class NotaFactory
    {
        public static nota createNota(string buyerName, string buyerPhoneNumber, DateTime buyDate, string employee_name, int totalPrice, int totalPayment, string paymentMethod, int userId)
        {
            nota newNota = new nota();
            newNota.buyer_name = buyerName;
            newNota.buyer_phone_number = buyerPhoneNumber;
            newNota.buy_date = buyDate;
            newNota.employee_name = employee_name;
            newNota.total_price = totalPrice;
            newNota.total_payment = totalPayment;
            newNota.payment_method = paymentMethod;
            newNota.user_id = userId;
            return newNota;
        }
    }
}