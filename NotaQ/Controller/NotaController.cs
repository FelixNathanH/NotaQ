using System;
using System.Collections.Generic;
using System.Linq;
using System.Text.RegularExpressions;
using System.Web;

namespace NotaQ.Controller
{
    public class NotaController
    {
        public static int ValidateBuyerName(string buyerName)
        {
            if (buyerName.Length > 100)
            {
                return 1;
            }else if (Regex.IsMatch(buyerName, "[0-9!@#$%^&*(),.?\":{}|<>]"))
            {
                return 2;
            }
            return 0;
        }

        public static int ValidateBuyerPhone(string buyerPhone)
        {
            if (Regex.IsMatch(buyerPhone, "[a-zA-Z]"))
            {
                return 1;
            }else if (!Regex.IsMatch(buyerPhone, "^(08|\\+62)\\d{1,122}$"))
            {
                return 2;
            }
            return 0;
        }

        public static int ValidateBuyerAssistant(string buyerAssistant)
        {
            if (buyerAssistant.Length > 100)
            {
                return 1;
            }else if (Regex.IsMatch(buyerAssistant, "[0-9!@#$%^&*(),.?\":{}|<>]"))
            {
                return 2;
            }
            return 3;
        }
    }
}