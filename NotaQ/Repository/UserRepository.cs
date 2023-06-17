using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using NotaQ.Model;

namespace NotaQ.Repository
{
    public class UserRepository
    {
        private static DatabaseEntities db = new DatabaseEntities();

        public user GetUser(String email, String password)
        {
            return (from x in db.user where x.email.Equals(email) && x.password.Equals(password) select x).FirstOrDefault();
        }
        public user AddUser(string name, string email, string phone, string password)
        {
            user newuser = new user();

            newuser.Id = db.user.Count() + 1;
            newuser.name = name;
            newuser.email = email;
            newuser.phone_number = phone;
            newuser.password = password;

            db.user.Add(newuser);
            db.SaveChanges();

            return newuser;
        }
    }
}