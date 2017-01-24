using System;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace Sistema.Aplication.ViewModels
{
   public class EnderecoViewModel
    {

        [Key]
        public int EnderecoId { get; set; }

        [Required(ErrorMessage = "Preencha o campo CEP")]
        [MaxLength(8, ErrorMessage = "Máximo {0} caracteres")]
        public String cep { get; set; }

        [Required(ErrorMessage = "Preencha o campo Logradouro")]
        [MaxLength(150, ErrorMessage = "Máximo {0} caracteres")]
        [MinLength(2, ErrorMessage = "Mínimo {0} caracteres")]
        public String logradouro { get; set; }

        [Required(ErrorMessage = "Preencha o campo Numero")]
        [MaxLength(10, ErrorMessage = "Máximo {0} caracteres")]
        [MinLength(2, ErrorMessage = "Mínimo {0} caracteres")]
        public String numero { get; set; }

        [Required(ErrorMessage = "Preencha o campo Complemento")]
        [MaxLength(150, ErrorMessage = "Máximo {0} caracteres")]
        [MinLength(2, ErrorMessage = "Mínimo {0} caracteres")]
        public String complemento { get; set; }

        [Required]
        [DisplayName("Bairro")]
        public String bairro { get; set; }

        [Required]
        [DisplayName("Cidade")]
        public String cidade { get; set; }

        [Required]
        [DisplayName("Estado")]       
        public String estado { get; set; }

    }
}
