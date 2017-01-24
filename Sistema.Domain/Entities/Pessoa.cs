using System;
using System.Collections.Generic;

namespace Sistema.Domain.Entities
{
    public class Pessoa
    {

        public Pessoa() {
            Enderecos = new List<Endereco>();
        }


        public int PessoaId { get; set; }
        public String Nome { get; set; }
        public String Email { get; set; }
        public String Telefone { get; set; }
        public String Celular { get; set; }
        public String CPF { get; set; }
        public String Mae { get; set; }
        public String Pai { get; set; }
        public String Sexo { get; set; }
        public String Naturalidade { get; set; }
        public String CartaoSUS { get; set; }
        public DateTime DataCadastro { get; set; }
        public String Ativo { get; set; }
        public virtual ICollection<Endereco> Enderecos { get; set; }
    }
}
