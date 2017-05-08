using System;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations;

namespace Sistema.UI.ViewModels
{
  public class EmpresaEnderecoViewModel
    {

        [Key]
        public int EnderecoId { get; set; }

        [Required(ErrorMessage = "Preencha o campo CEP")]
        [MaxLength(9, ErrorMessage = "Máximo {0} caracteres")]
        [DisplayName("cep")]
        public String cep { get; set; }

        [Required(ErrorMessage = "Preencha o campo Logradouro")]
        [MaxLength(150, ErrorMessage = "Máximo {0} caracteres")]
        [MinLength(2, ErrorMessage = "Mínimo {0} caracteres")]
        [DisplayName("logradouro")]
        public String logradouro { get; set; }

        [Required(ErrorMessage = "Preencha o campo Numero")]
        [MaxLength(10, ErrorMessage = "Máximo {0} caracteres")]
        [MinLength(2, ErrorMessage = "Mínimo {0} caracteres")]
        [DisplayName("numero")]
        public String numero { get; set; }

        [DisplayName("complemento")]
        public string complemento { get; set; }

        [Required]
        [DisplayName("bairro")]
        public String bairro { get; set; }

        [Required]
        [DisplayName("cidade")]
        public String cidade { get; set; }

        [Required]
        [DisplayName("estado")]
        public String estado { get; set; }

        [Key]
        public int EmpresaId { get; set; }

        [Required(ErrorMessage = "Preencha o campo Nome")]
        [MaxLength(150, ErrorMessage = "Máximo {0} caracteres")]
        [MinLength(2, ErrorMessage = "Mínimo {0} caracteres")]
        [DisplayName("Nome")]
        public String Nome { get; set; }

        [Required(ErrorMessage = "Preencha o campo CNPJ")]
        [MaxLength(30, ErrorMessage = "Máximo {0} caracteres")]
        [DisplayName("CNPJ")]
        public String CNPJ { get; set; }

        [DisplayName("NomeFantasia")]
        public String NomeFantasia { get; set; }

        [DisplayName("Situacao")]
        public String Situacao { get; set; }

        [DisplayName("Telefone")]
        public String Telefone { get; set; }

        [DisplayName("Email")]
        public String Email { get; set; }

        [DisplayName("Abertura")]
        public String Abertura { get; set; }

        [DisplayName("NaturezaJuridica")]
        public String NaturezaJuridica { get; set; }

        [DisplayName("AtividadePrincipal")]
        public String AtividadePrincipal { get; set; }

        [DisplayName("Codigo")]
        public String Codigo { get; set; }

        [DisplayName("Ativo")]
        public String Ativo { get; set; }

        [ScaffoldColumn(false)]
        public DateTime DataCadastro { get; set; }


    }
}
