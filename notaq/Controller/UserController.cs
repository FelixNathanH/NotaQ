using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using notaq.Repository;
using notaq.Models;

namespace notaq.Controller
{
    public class UserController
    {
        private static UserRepository userRepo = new UserRepository();
        
        public (User, List<int>) UserRegister(String realName, String shopName, String userName, String phoneNumber, String password)
        {
            List<int> errorList = new List<int>();
            String[] registerInfo = { realName, shopName, userName, phoneNumber, password };

            if (userRepo.GetUser(userName, password) != null)// Show user already exist
            {
                return (null, null);
            }

            if (!CheckError(errorList, registerInfo))
            {
                User user = userRepo.AddUser(registerInfo);
                return (user, null);
            }
            else
            {
                return (null, errorList);
            }
        }
        public bool CheckError(List<int> errorList, String[] registerInfo)
        {
            for (int i = 0; i < registerInfo.Length; i++)
            {
                if (i == 3) //phoneNumber
                {
                    if (!CheckLetter(registerInfo[i])) //false
                    {
                        errorList.Add(i);
                        continue;
                    }
                }
                if (string.IsNullOrEmpty(registerInfo[i]))
                    errorList.Add(i);
            }
            if (errorList.Count == 0)
                return false;

            return true; //else
        }

        public bool CheckLetter(String input)
        {
            foreach (char digit in input)
            {
                if (digit < '0' || digit > '9')
                {
                    return false;
                }
            }
            return true; // If no letters
        }
        public User UserLogin(String username, String password)
        {
            User user = userRepo.GetUser(username, password);
            if (user == null)
                return null;
            else
                return user;
        }
    }
}