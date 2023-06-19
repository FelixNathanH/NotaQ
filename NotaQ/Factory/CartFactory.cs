using NotaQ.Model;

namespace NotaQ.Factory
{
    public class CartFactory
    {
        public static cart createCart(int id, string product_name, int product_price, int product_quantity)
        {
            cart newCart = new cart();
            if (id == 0)
            {
                newCart.cart_product_id = null;
            }
            else
            {
                newCart.cart_product_id = id;
            }
            newCart.cart_product_name = product_name;
            newCart.cart_product_price = product_price;
            newCart.cart_product_quantity = product_quantity;

            return newCart;
        }
    }
}