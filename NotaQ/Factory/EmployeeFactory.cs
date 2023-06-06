using NotaQ.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace NotaQ.Factory
{
    public class EmployeeFactory
    {
        public employee CreateEmployee(int id, string employee_name, string employee_phone_number, string employee_address, string employee_description)
        {
            employee newEmployee = new employee();
            newEmployee.Id = id;
            newEmployee.employee_name = employee_name;
            newEmployee.employee_phone_number = employee_phone_number;
            newEmployee.employee_address = employee_address;
            newEmployee.employee_description = employee_description;
            return newEmployee;
        }
    }
}