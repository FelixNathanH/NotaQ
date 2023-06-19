using NotaQ.Model;
using System;

namespace NotaQ.Factory
{
    public class HutangFactory
    {
        public static hutang createHutang(int nota_id, string debtor_name, string debtor_email, string debtor_phone_number, string debtor_address, DateTime debtor_deadline, int debt_reminder_frequency, int debt_total, int uid)
        {
            hutang newHutang = new hutang();
            newHutang.nota_id = nota_id;
            newHutang.debtor_name = debtor_name;
            newHutang.debtor_email = debtor_email;
            newHutang.debtor_phone_number = debtor_phone_number;
            newHutang.debtor_address = debtor_address;
            newHutang.debtor_deadline = debtor_deadline;
            newHutang.debt_reminder_frequency = debt_reminder_frequency;
            newHutang.debt_total = debt_total;
            newHutang.user_id = uid;
            return newHutang;
        }
    }
}