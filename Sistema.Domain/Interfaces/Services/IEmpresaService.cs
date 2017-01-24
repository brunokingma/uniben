using Sistema.Domain.Entities;
using System;
using System.Collections.Generic;


namespace Sistema.Domain.Interfaces.Services
{
   public interface IEmpresaService: IDisposable
    {

        void Adicionar(Empresa empresa);
        Empresa ObterPorId(int id);
        Empresa ObterPorCNPJ(String cnpj);
        IEnumerable<Empresa> ObterTodos();
        void Atualizar(Empresa empresa);
        void Remover(Empresa empresa);



    }
}
