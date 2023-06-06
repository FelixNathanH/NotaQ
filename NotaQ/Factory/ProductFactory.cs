using NotaQ.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace NotaQ.Factory
{
    public class ProductFactory
    {
        public product CreateProduct(int id, string product_name, int product_price, int product_stock, string product_description)
        {
            product newProduct = new product();
            newProduct.Id = id;
            newProduct.product_name = product_name;
            newProduct.product_price = product_price;
            newProduct.product_stock = product_stock;
            newProduct.product_description = product_description;
            return newProduct;
        }
    }
}