using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using NotaQ.Model;
using NotaQ.Repository;

namespace NotaQ.Controller
{
    public class UserController
    {
        private static UserRepository userRepo = new UserRepository();

        public (user, List<int>) UserRegister(String name, String email, String phoneNumber, String password)
        {
            List<int> errorList = new List<int>();
            String[] registerInfo = { name, email, phoneNumber, password };

            if (userRepo.GetUser(email, password) != null)// Show user already exist
            {
                return (null, null);
            }

            if (!CheckError(errorList, registerInfo))
            {
                user newuser = userRepo.AddUser(name, email, phoneNumber, password);
                return (newuser, null);
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
                if (i == 2) //phoneNumber
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
        public user UserLogin(String email, String password)
        {
            user newuser = userRepo.GetUser(email, password);
            if (newuser == null)
                return null;
            else
                return newuser;
        }
    }
}