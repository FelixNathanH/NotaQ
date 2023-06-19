using NotaQ.Model;

namespace NotaQ.Repository
{
    public class HutangRepo
    {
        static DatabaseEntities db = DatabaseSingleton.getInstance();
        public static void AddHutang(hutang newHutang)
        {
            db.hutang.Add(newHutang);
            db.SaveChanges();
        }

        public static void DeleteHutang(hutang hutang)
        {
            db.hutang.Remove(hutang);
            db.SaveChanges();
        }
    }
}
