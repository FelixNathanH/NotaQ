using NotaQ.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace NotaQ.Repository
{
    public class EmployeeRepo
    {
        static DatabaseEntities db = DatabaseSingleton.getInstance();
        public static void AddEmployee(employee newEmployee)
        {
            db.employee.Add(newEmployee);
            db.SaveChanges();
        }

        public static void DeleteEmployee(employee employee)
        {
            db.employee.Remove(employee);
            db.SaveChanges();
        }
    }
}
