using Sistema.Domain.Entities;
using System;

namespace Sistema.Domain.Interfaces.Services
{
   public interface IEmpresaService: IDisposable, IServiceBase<Empresa>
   {
       Empresa ObterPorCnpj(string cnpj);
   }
}
