using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace Sistema.UI.ViewModels
{
    public class EmpresaViewModel
    {


        [Key]
        public int EmpresaId { get; set; }

        [Required(ErrorMessage ="Preencha o campo Nome")]
        [MaxLength(150, ErrorMessage = "Máximo {0} caracteres")]
        [MinLength(2, ErrorMessage = "Mínimo {0} caracteres")]
        public String Nome { get; set; }

        [Required(ErrorMessage = "Preencha o campo CNPJ")]
        [MaxLength(30, ErrorMessage = "Máximo {0} caracteres")]
        public String CNPJ { get; set; }

      
        public String NomeFantasia { get; set; }

      
        public String Situacao { get; set; }

        
        public String Telefone { get; set; }

        public String Email { get; set; }

       
        public String Abertura { get; set; }

        public String NaturezaJuridica { get; set; }

       
        public String AtividadePrincipal { get; set; }

        
        public String Codigo { get; set; }

        [ScaffoldColumn(false)]
        public String Ativo { get; set; }

        [ScaffoldColumn(false)]
        public DateTime DataCadastro { get; set; }

    }
}
