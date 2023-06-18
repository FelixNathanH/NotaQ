using System;
using System.Collections.Generic;
using System.Linq;
using System.Text.RegularExpressions;
using System.Web;

namespace NotaQ.Controller
{
    public class NotaController
    {
        public static string ValidateBuyerName(string buyerName)
        {
            if (string.IsNullOrEmpty(buyerName))
            {
                return "Nama pembeli tidak boleh kosong.";
            }
            else if (buyerName.Length < 3)
            {
                return "Nama pembeli terlalu pendek, minimal 3 karakter";
            }
            else if (buyerName.Length > 100)
            {
                return "Nama teralu panjang, maksimal 100 karakter";
            }
            else if (Regex.IsMatch(buyerName, "[0-9!@#$%^&*(),.?\":{}|<>]"))
            {
                return "Nama tidak boleh mengandung nomor atau simbol";
            }
            return "";
        }

        public static string ValidateBuyerPhone(string buyerPhone)
        {
            if (buyerPhone.Length < 12)
            {
                return "Nomor telepon tidak valid";
            }
            else if (Regex.IsMatch(buyerPhone, "[a-zA-Z]"))
            {
                return "Nomor telepon tidak boleh mengandung huruf";
            }
            else if (!Regex.IsMatch(buyerPhone, "^(08|\\+62)\\d{1,122}$"))
            {
                return "Nomor telepon harus diawali dengan 08 atau +62";
            }

            if (buyerPhone.StartsWith("+62"))
            {
                if (buyerPhone.Length != 14)
                {
                    return "Nomor telepon tidak valid";
                }
            }
            else if (buyerPhone.StartsWith("08"))
            {
                if (buyerPhone.Length != 12)
                {
                    return "Nomor telepon tidak valid";
                }
            }
            return "";
        }

        public static string ValidateBuyerAssistant(string buyerAssistant)
        {
            if (!string.IsNullOrEmpty(buyerAssistant))
            {
                if (buyerAssistant.Length < 3)
                {
                    return "Nama teralu pendek, minimal 3 karakter";
                }
                else if (buyerAssistant.Length > 100)
                {
                    return "Nama teralu panjang, maksimal 100 karakter";
                }
                else if (Regex.IsMatch(buyerAssistant, "[0-9!@#$%^&*(),.?\":{}|<>]"))
                {
                    return "Nama tidak boleh mengandung nomor atau simbol";
                }
            }

            return "";
        }

        public static string ValidateProduct(int productCnt)
        {
            if (productCnt < 1)
            {
                return "Tidak ada pembelian";
            }
            return "";
        }

        public static string ValidatePaid(string paidAmount)
        {
            if (Regex.IsMatch(paidAmount, "[a-zA-Z!@#$%^&*(),.?\":{}|<>]"))
            {
                return "Pembayaran tidak boleh mengandung huruf atau simbol";
            }
            return "";
        }

        public static int ConvertToInt(string input)
        {
            return int.TryParse(input, out int intRes) ? intRes : -1;
        }

        public static string ConvertPhn(string buyerPhn)
        {

            if (buyerPhn.StartsWith("08"))
            {
                string cleanNum = buyerPhn.TrimStart('0');

                return "+62" + cleanNum;
            }
            return buyerPhn;
        }

        public static bool checkNull(string input)
        {
            return input == null;
        }

        public static bool CheckInt(string input)
        {
            int result;
            return int.TryParse(input, out result);
        }

        public static string ValidateNewProduct(int productCnt)
        {
            if (productCnt < 1)
            {
                return "Tidak ada pembelian";
            }
            return "";
        }

        public static string validateProductPrice(string price)
        {
            if (string.IsNullOrEmpty(price))
            {
                return "Harga tidak boleh kosong";
            }

            int result;
            if (!int.TryParse(price, out result))
            {
                return "Harga harus dalam bentuk angka.";
            }

            return "";
        }
        public static string validateProductQuantity(string Quantity)
        {
            if (string.IsNullOrEmpty(Quantity))
            {
                return "Jumlah dibeli tidak boleh kosong";
            }

            int result;
            if (!int.TryParse(Quantity, out result))
            {
                return "Jumlah dibeli harus dalam bentuk angka.";
            }

            return "";
        }

        public static string toCurrency(int angka)
        {
            return "Rp." + angka.ToString("N0");
        }

    }
}