using Sistema.Domain.Interfaces.Services;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Sistema.Domain.Entities;
using Sistema.Domain.Interfaces.Repository;

namespace Sistema.Domain.Services
{
    public class EmpresaService : IEmpresaService
    {


        private readonly IEmpresaRepository _empresaRepository;

        public EmpresaService(IEmpresaRepository empresaRepository) {
            _empresaRepository = empresaRepository;
        }

        public void Adicionar(Empresa empresa)
        {
            _empresaRepository.Add(empresa);
        }

        public void Atualizar(Empresa empresa)
        {
            _empresaRepository.Update(empresa);
        }

        public void Dispose()
        {
            _empresaRepository.Dispose();
            GC.SuppressFinalize(this);
        }

        public Empresa ObterPorCNPJ(string cnpj)
        {
          return _empresaRepository.BuscarPorCNPJ(cnpj);
        }

        public Empresa ObterPorId(int id)
        {
            return _empresaRepository.GetById(id);

        }

        public IEnumerable<Empresa> ObterTodos()
        {
            return _empresaRepository.GetAll();
        }

        public void Remover(Empresa empresa)
        {
            _empresaRepository.Remove(empresa);
        }
    }
}
