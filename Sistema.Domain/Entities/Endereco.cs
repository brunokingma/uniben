using System;

namespace Sistema.Domain.Entities
{
    public class Endereco
    {
      

        public int EnderecoId { get; set; }
        public String cep { get; set; }
        public String logradouro { get; set; }
        public String numero { get; set; }
        public String complemento { get; set; }
        public String bairro { get; set; }
        public String cidade { get; set; }
        public String estado { get; set; }


    }
}
