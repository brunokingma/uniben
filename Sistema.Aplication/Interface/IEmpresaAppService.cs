using Sistema.Aplication.ViewModels;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Sistema.Aplication.Interface
{
   public  interface IEmpresaAppService: IDisposable
    {
        void Adicionar(EmpresaEnderecoViewModel empresa);
        EmpresaViewModel ObterPorId(int id);
        EmpresaViewModel ObterPorCNPJ(String cnpj);
        IEnumerable<EmpresaViewModel> ObterTodos();
        void Atualizar(EmpresaViewModel empresa);
        void Remover(EmpresaViewModel empresa);


    }
}
