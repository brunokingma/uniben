using Sistema.Domain.Entities;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Sistema.Domain.Interfaces.Repository
{
    public interface IEmpresaRepository : IBaseRepository<Empresa>
    {
        Empresa BuscarPorCNPJ(String cnpj);        
    }
}
