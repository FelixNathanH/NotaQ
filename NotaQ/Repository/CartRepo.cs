using NotaQ.Model;
using System.Collections.Generic;
using System.Linq;

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

        public static void DeleteCart(int id)
        {
            cart delCart = db.cart.Where(x => x.Id == id).FirstOrDefault();
            db.cart.Remove(delCart);
            db.SaveChanges();
        }

        public static void DeleteAllCart(int id)
        {
            db.cart.RemoveRange(db.cart.Where(x => x.Id == id));
            db.SaveChanges();
        }

        public static List<cart> GetCart()
        {
            return db.cart.ToList();
        }

        public static int findByName(string name)
        {
            cart foundCart = db.cart.Where(x => x.cart_product_name == name).FirstOrDefault();
            if (foundCart != null)
            {
                return foundCart.Id;
            }
            return -1;
        }

        public static void updateQuantity(int id, int newQuantity)
        {
            cart cartToUpdate = db.cart.Find(id);
            if (cartToUpdate != null)
            {
                cartToUpdate.cart_product_quantity = cartToUpdate.cart_product_quantity + newQuantity;
                db.SaveChanges();
            }
        }

    }
}