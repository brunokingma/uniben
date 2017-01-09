using System;

namespace Sistema.Domain.Entities
{
    public class Endereco
    {

        public Endereco() {
            EnderecoId = Guid.NewGuid();
        }

        public Guid EnderecoId { get; set; }
        public String cep { get; set; }
        public String logradouro { get; set; }
        public String numero { get; set; }
        public String complemento { get; set; }
        public String bairro { get; set; }
        public String cidade { get; set; }
        public String estado { get; set; }
        public Guid EmpresaId { get; set; }
        public virtual Empresa Empresa { get; set; }

    }
}
