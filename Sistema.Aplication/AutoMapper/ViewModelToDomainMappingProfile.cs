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
    public class ViewModelToDomainMappingProfile : Profile
    {

        public override string ProfileName
        {
            get
            {
                return "ViewModelToDomainMapping";
            }
        }


        protected override void Configure()
        {
            CreateMap<EmpresaViewModel, Empresa>();
            CreateMap<EnderecoViewModel,Endereco>();
            CreateMap<EmpresaEnderecoViewModel, Empresa>();
            CreateMap<EmpresaEnderecoViewModel, Endereco>();
        }

    }
}
