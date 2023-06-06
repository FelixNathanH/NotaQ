using NotaQ.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace NotaQ.Factory
{
    public class UserFactory
    {
        public user CreateUser(int id, string name, string email, string phoneNumber, string password)
        {
            user newUser = new user();
            newUser.Id = id;
            newUser.name = name;
            newUser.email = email;
            newUser.phone_number = phoneNumber;
            newUser.password = password;
            return newUser;
        }
    }
}