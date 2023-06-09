using NotaQ.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace NotaQ.Repository
{
    
    public class UserRepo
    {
        static DatabaseEntities db = DatabaseSingleton.getInstance();
        public static void addUser(user newuser)
        {
            db.user.Add(newuser);
            db.SaveChanges();
        }
        public static void deleteUser(user newuser)
        {
            db.user.Remove(newuser);
            db.SaveChanges();
        }
    }
}
