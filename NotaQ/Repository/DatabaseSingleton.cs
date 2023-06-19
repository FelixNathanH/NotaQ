using NotaQ.Model;

namespace NotaQ.Repository
{
    public class DatabaseSingleton
    {
        private static DatabaseEntities db = null;

        public static DatabaseEntities getInstance()
        {
            if (db == null)
            {
                db = new DatabaseEntities();
            }
            return db;
        }
    }
}