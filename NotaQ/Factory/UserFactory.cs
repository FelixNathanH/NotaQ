using NotaQ.Model;

namespace NotaQ.Factory
{
    public class UserFactory
    {
        public user createUser(int id, string name, string email, string phoneNumber, string password)
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