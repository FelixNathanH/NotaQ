﻿using NotaQ.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace NotaQ.Repository
{
    public class ProductRepo
    {
        static DatabaseEntities db = DatabaseSingleton.getInstance();
        public static void AddProduct(product newProduct)
        {
            db.product.Add(newProduct);
            db.SaveChanges();
        }

        public static void DeleteProduct(product product)
        {
            db.product.Remove(product);
            db.SaveChanges();
        }
    }
}