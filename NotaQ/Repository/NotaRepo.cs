﻿using NotaQ.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace NotaQ.Repository
{
    public class NotaRepo
    {
        static DatabaseEntities db = DatabaseSingleton.getInstance();
        public static void AddHutang(nota newnota)
        {
            db.nota.Add(newnota);
            db.SaveChanges();
        }

        public static void DeleteHutang(nota nota)
        {
            db.nota.Remove(nota);
            db.SaveChanges();
        }
    }
}