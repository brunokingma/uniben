using AutoMapper;
using Sistema.Domain.Entities;
using Sistema.UI.ViewModels;

namespace Sistema.UI.AutoMapper
{
   public  class DomainToViewModelMappingProfile:Profile
    {
        public DomainToViewModelMappingProfile()
        {
            CreateMap<Empresa, EmpresaViewModel>();
            CreateMap<Endereco, EnderecoViewModel>();
            CreateMap<Empresa, EmpresaEnderecoViewModel>();
            CreateMap<Endereco, EmpresaEnderecoViewModel>();
        }
    }
}
