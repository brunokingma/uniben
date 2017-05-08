using AutoMapper;
using Sistema.UI.ViewModels;
using Sistema.Domain.Entities;

namespace Sistema.UI.AutoMapper
{
    public class ViewModelToDomainMappingProfile : Profile
    {
        public ViewModelToDomainMappingProfile()
        {
            CreateMap<EmpresaViewModel, Empresa>();
            CreateMap<EnderecoViewModel, Endereco>();
            CreateMap<EmpresaEnderecoViewModel, Empresa>();
            CreateMap<EmpresaEnderecoViewModel, Endereco>();
        }

    }
}
