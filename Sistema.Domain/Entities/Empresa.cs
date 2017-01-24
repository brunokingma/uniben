
using System;
using System.Collections.Generic;

namespace Sistema.Domain.Entities
{
    public class Empresa
    {

        public Empresa()
        {
            Enderecos = new List<Endereco>();
        }


        public int EmpresaId { get; set; }
        public String Nome { get; set; }
        public String CNPJ { get; set; }
        public String NomeFantasia { get; set; }
        public String Situacao { get; set; }
        public String Telefone { get; set; }
        public String Email { get; set; }
        public String Abertura { get; set; }
        public String NaturezaJuridica { get; set; }
        public String AtividadePrincipal { get; set; }
        public String Codigo { get; set; }
        public String Ativo { get; set; }
        public virtual ICollection<Endereco> Enderecos { get; set; }

    }
}
