using NotaQ.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace NotaQ.Repository
{
    public class CartRepo
    {
        static DatabaseEntities db = DatabaseSingleton.getInstance();
        public static void AddCart(cart newCart)
        {
            db.cart.Add(newCart);
            db.SaveChanges();
        }

        public static void DeleteCart(cart cart)
        {
            db.cart.Remove(cart);
            db.SaveChanges();
        }

        public static List<cart> GetCart()
        {
            return db.cart.ToList();
        }
    }
}