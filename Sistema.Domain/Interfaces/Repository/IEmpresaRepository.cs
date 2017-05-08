using Sistema.Domain.Entities;
using System;

namespace Sistema.Domain.Interfaces.Repository
{
    public interface IEmpresaRepository : IBaseRepository<Empresa>
    {
        Empresa BuscarPorCNPJ(String cnpj);        
    }
}
