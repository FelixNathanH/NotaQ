using NotaQ.Model;

namespace NotaQ.Repository
{
    public class NotaRepo
    {
        static DatabaseEntities db = DatabaseSingleton.getInstance();
        public static void AddNota(nota newnota)
        {
            db.nota.Add(newnota);
            db.SaveChanges();
        }

        public static void DeleteNota(nota nota)
        {
            db.nota.Remove(nota);
            db.SaveChanges();
        }
    }
}