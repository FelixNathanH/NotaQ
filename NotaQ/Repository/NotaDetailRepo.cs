using NotaQ.Model;

namespace NotaQ.Repository
{
    public class NotaDetailRepo
    {
        static DatabaseEntities db = DatabaseSingleton.getInstance();
        public static void AddHutang(nota_detail newNotaDetail)
        {
            db.nota_detail.Add(newNotaDetail);
            db.SaveChanges();
        }

        public static void DeleteHutang(nota_detail notaDetail)
        {
            db.nota_detail.Remove(notaDetail);
            db.SaveChanges();
        }
    }
}