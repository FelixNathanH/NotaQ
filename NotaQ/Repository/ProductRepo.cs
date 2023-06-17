using NotaQ.Model;
using NotaQ.Factory;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace NotaQ.Repository
{
    public class ProductRepo
    {
        static DatabaseEntities db = DatabaseSingleton.getInstance();
        public static void AddProduct(int user_id, string name, int price, int stock, string description)
        {
            product product = ProductFactory.createProduct(user_id, name, price, stock, description);

            db.product.Add(product);
            db.SaveChanges();
        }

        public static void DeleteProduct(product product)
        {
            db.product.Remove(product);
            db.SaveChanges();
        }
        public static void editProduct(int productId, string productName, int productPrice, int productStock, string productDescription)
        {
            product product = FindById(productId);

            if (product != null)
            {
                ProductFactory.editProduct(product, productName, productPrice, productStock, productDescription);
                db.SaveChanges();
            }
        }
        public static List<product> SearchProductsByName(string productName)
        {
            return db.product.Where(p => p.product_name.Contains(productName)).ToList();
        }

        public static product SearchProductByName(string productName)
        {
            return db.product.FirstOrDefault(p => p.product_name.Contains(productName));
        }

        public static product SearchProductById(int productId)
        {
            return db.product.FirstOrDefault(p => p.Id == productId);
        }
        public static product FindById(int productId)
        {
            return (from p in db.product where p.Id == productId select p).FirstOrDefault();
        }
    }
}
