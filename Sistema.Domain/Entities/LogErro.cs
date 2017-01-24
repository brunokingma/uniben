using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Sistema.Domain.Entities
{
    public class LogErro
    {


        public LogErro() {

        }



        public string Detalhe { get; set; }
        public string Propriedade { get; set; }
        public string Entidade { get; set; }
    }
}
