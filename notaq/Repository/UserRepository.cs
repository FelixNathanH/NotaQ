using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using notaq.Models;

namespace notaq.Repository
{
    public class UserRepository
    {
        private static AccountEntities db = new AccountEntities();

        public User GetUser(String username, String password)
        {
            return (from x in db.Users where x.username.Equals(username) && x.password.Equals(password) select x).FirstOrDefault();
        }
        public User AddUser(String[] registerInfo)
        {
            User user = new User();

            user.Id = "USER" + Convert.ToString(db.Users.Count<User>() + 1);
            user.realname = registerInfo[0];
            user.shopname = registerInfo[1];
            user.username = registerInfo[2];
            user.phonenumber = registerInfo[3];
            user.password = registerInfo[4];

            db.Users.Add(user);
            db.SaveChanges();

            return user;
        }
    }
}