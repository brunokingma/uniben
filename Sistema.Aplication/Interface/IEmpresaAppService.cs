using System;
using System.Collections.Generic;
using Sistema.UI.ViewModels;

namespace Sistema.Aplication.Interface
{
   public  interface IEmpresaAppService: IDisposable
    {
        void Adicionar(EmpresaEnderecoViewModel empresa);
        EmpresaViewModel ObterPorId(int id);
        EmpresaViewModel ObterPorCnpj(string cnpj);
        IEnumerable<EmpresaViewModel> ObterTodos();
        void Atualizar(EmpresaViewModel empresa);
        void Remover(EmpresaViewModel empresa);
    }
}
