using Sistema.Domain.Entities;
using Sistema.Domain.Interfaces.Repository;
using System.Collections.Generic;
using System.Linq;

namespace Sistema.Data.Repositories
{
    public class EmpresaRepository : BaseRepository<Empresa>, IEmpresaRepository
    {
        public Empresa BuscarPorCNPJ(string cnpj)
        {
            return Find(c=>c.CNPJ == cnpj).FirstOrDefault();
        }

        public List<Empresa> BuscarPorNome(string nome)
        {           
            return Find(c => c.Nome.Contains(nome)).ToList();
        }
    }
}
