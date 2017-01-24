using Sistema.Aplication.Interface;
using System;
using System.Collections.Generic;
using Sistema.Aplication.ViewModels;
using Sistema.Data.Repositories;
using Sistema.Domain.Entities;
using AutoMapper;

namespace Sistema.Aplication
{
    public class EmpresaAppService : IEmpresaAppService
    {

        private readonly EmpresaRepository _empresaRepository = new EmpresaRepository();


        public void Adicionar(EmpresaEnderecoViewModel empresaEnderecoViewModel)
        {
            var endereco = Mapper.Map<EmpresaEnderecoViewModel, Endereco>(empresaEnderecoViewModel);
            var empresa =  Mapper.Map<EmpresaEnderecoViewModel, Empresa>(empresaEnderecoViewModel);
            empresa.Enderecos.Add(endereco);
           _empresaRepository.Add(empresa);
        }

        public void Atualizar(EmpresaViewModel empresa)
        {
            throw new NotImplementedException();
        }

        public void Dispose()
        {
            throw new NotImplementedException();
        }

        public EmpresaViewModel ObterPorCNPJ(string cnpj)
        {
            throw new NotImplementedException();
        }

        public EmpresaViewModel ObterPorId(int id)
        {
            throw new NotImplementedException();
        }

        public IEnumerable<EmpresaViewModel> ObterTodos()
        {
            var empresa = _empresaRepository.GetAll();
            return Mapper.Map<IEnumerable<Empresa>,IEnumerable<EmpresaViewModel>>(empresa);
        }

        public IEnumerable<Empresa> ObterTodosComEnderecoJson(String nome)
        {
            var empresa = _empresaRepository.BuscarPorNome(nome);
            return empresa;
        }

        public void Remover(EmpresaViewModel empresa)
        {
            throw new NotImplementedException();
        }
    }
}
