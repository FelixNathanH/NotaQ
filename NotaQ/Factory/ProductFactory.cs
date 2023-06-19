using NotaQ.Model;

namespace NotaQ.Factory
{
    public class ProductFactory
    {
        public static product createProduct(int user_id, string product_name, int product_price, int product_stock, string product_description)
        {
            product newProduct = new product();
            newProduct.user_id = user_id;
            newProduct.product_name = product_name;
            newProduct.product_price = product_price;
            newProduct.product_stock = product_stock;
            newProduct.product_description = product_description;
            return newProduct;
        }
        public static void editProduct(product product, string product_name, int product_price, int product_stock, string product_description)
        {
            product.product_name = product_name;
            product.product_price = product_price;
            product.product_stock = product_stock;
            product.product_description = product_description;
        }
    }
}