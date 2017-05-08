using System;

namespace Sistema.Domain.Entities
{
    public class Log
    {
        public Log()
        {
            DateTime DataAcao = DateTime.Today;
        }

        public String Usuario { get; set; }
        public String Acao { get; set; }
        public DateTime DataAcao { get; set; }

       
    }
}
