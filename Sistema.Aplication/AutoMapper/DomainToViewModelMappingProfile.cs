using AutoMapper;
using Sistema.Aplication.ViewModels;
using Sistema.Domain.Entities;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Sistema.Aplication.AutoMapper
{
   public  class DomainToViewModelMappingProfile:Profile
    {

        public override string ProfileName
        {
            get
            {
                return "DomainToViewModelMapping";
            }
        }


        protected override void Configure()
        {
            CreateMap<Empresa, EmpresaViewModel>();
            CreateMap<Endereco, EnderecoViewModel>();
            CreateMap<Empresa, EmpresaEnderecoViewModel>();
            CreateMap<Endereco, EmpresaEnderecoViewModel>();
        }

    }
}
