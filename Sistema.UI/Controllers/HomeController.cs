using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace Uniben.UI.Controllers
{
    public class HomeController : Controller
    {
        public ActionResult Index()
        {
            return View();
        }

        public ActionResult About()
        {
            ViewBag.Message = "Your application description page.";

            return View();
        }



        public ActionResult Teste()
        {
            ViewBag.Message = "{ \"total_rows\": \"200\",\"page_data\": [ { \"id\": \"1\",\"lastname\": \"Kingma\",\"firstname\": \"Bruno\", \"email\": \"brunokingma@gmail.com\",\"gender\": \"data\", \"detalhes\":\"<a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Exibir detalhes'> <button type='button' class='btn btn-primary'><i class='fa  fa-eye' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar cadastro'> <button type='button' class='btn btn-primary'><i class='fa  fa-edit' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Imprimir ficha' > <button type='button'class='btn btn-primary'><i class='fa  fa-print' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Ativar/Excluir' > <button type='button'class='btn btn-primary'><i class='fa  fa-check' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='editar dependentes' > <button type='button'class='btn btn-primary'><i class='fa  fa-group' aria-hidden='true' ></i> </button></a>\" },{ \"id\": \"2\",\"lastname\": \"Kingma\",\"firstname\": \"Bruno\", \"email\": \"brunokingma@gmail.com\",\"gender\": \"data\", \"detalhes\":\"<a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Exibir detalhes'> <button type='button' class='btn btn-primary'><i class='fa  fa-eye' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar cadastro'> <button type='button' class='btn btn-primary'><i class='fa  fa-edit' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Imprimir ficha' > <button type='button'class='btn btn-primary'><i class='fa  fa-print' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Ativar/Excluir' > <button type='button'class='btn btn-primary'><i class='fa  fa-check' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='editar dependentes' > <button type='button'class='btn btn-primary'><i class='fa  fa-group' aria-hidden='true' ></i> </button></a>\" },{ \"id\": \"3\",\"lastname\": \"Kingma\",\"firstname\": \"Bruno\", \"email\": \"brunokingma@gmail.com\",\"gender\": \"data\", \"detalhes\":\"<a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Exibir detalhes'> <button type='button' class='btn btn-primary'><i class='fa  fa-eye' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar cadastro'> <button type='button' class='btn btn-primary'><i class='fa  fa-edit' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Imprimir ficha' > <button type='button'class='btn btn-primary'><i class='fa  fa-print' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Ativar/Excluir' > <button type='button'class='btn btn-primary'><i class='fa  fa-check' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='editar dependentes' > <button type='button'class='btn btn-primary'><i class='fa  fa-group' aria-hidden='true' ></i> </button></a>\" },{ \"id\": \"41\",\"lastname\": \"Kingma\",\"firstname\": \"Bruno\", \"email\": \"brunokingma@gmail.com\",\"gender\": \"data\", \"detalhes\":\"<a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Exibir detalhes'> <button type='button' class='btn btn-primary'><i class='fa  fa-eye' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar cadastro'> <button type='button' class='btn btn-primary'><i class='fa  fa-edit' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Imprimir ficha' > <button type='button'class='btn btn-primary'><i class='fa  fa-print' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Ativar/Excluir' > <button type='button'class='btn btn-primary'><i class='fa  fa-check' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='editar dependentes' > <button type='button'class='btn btn-primary'><i class='fa  fa-group' aria-hidden='true' ></i> </button></a>\" },{ \"id\": \"5\",\"lastname\": \"Kingma\",\"firstname\": \"Bruno\", \"email\": \"brunokingma@gmail.com\",\"gender\": \"data\", \"detalhes\":\"<a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Exibir detalhes'> <button type='button' class='btn btn-primary'><i class='fa  fa-eye' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar cadastro'> <button type='button' class='btn btn-primary'><i class='fa  fa-edit' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Imprimir ficha' > <button type='button'class='btn btn-primary'><i class='fa  fa-print' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Ativar/Excluir' > <button type='button'class='btn btn-primary'><i class='fa  fa-check' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='editar dependentes' > <button type='button'class='btn btn-primary'><i class='fa  fa-group' aria-hidden='true' ></i> </button></a>\" },{ \"id\": \"6\",\"lastname\": \"Kingma\",\"firstname\": \"Bruno\", \"email\": \"brunokingma@gmail.com\",\"gender\": \"data\", \"detalhes\":\"<a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Exibir detalhes'> <button type='button' class='btn btn-primary'><i class='fa  fa-eye' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar cadastro'> <button type='button' class='btn btn-primary'><i class='fa  fa-edit' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Imprimir ficha' > <button type='button'class='btn btn-primary'><i class='fa  fa-print' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Ativar/Excluir' > <button type='button'class='btn btn-primary'><i class='fa  fa-check' aria-hidden='true' ></i> </button></a><a href='/Cliente/DetalheCliente'  data-toggle='tooltip' data-placement='top' title='' data-original-title='editar dependentes' > <button type='button'class='btn btn-primary'><i class='fa  fa-group' aria-hidden='true' ></i> </button></a>\" }]}";

            return View();
        }


        public ActionResult Teste2()
        {
            ViewBag.Message = "{ \"total_rows\": \"200\",\"page_data\": [ { \"id\": \"1\",\"lastname\": \"Kingma\",\"firstname\": \"Victor\", \"cpf\": \"044.385.916-78\",\"anexo\": \"documento01\", \"detalhes\":\"<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalAnexo'><i class='fa  fa-paperclip' aria-hidden='true' ></i> </button> <a href='/Cliente/DetalheCliente' ><button type='button' class='btn btn-primary' ><i class='fa  fa-edit' aria-hidden='true' ></i> </button></a>\" }]}";

            return View();
        }


        public ActionResult Teste3()
        {
            ViewBag.Message = "{ \"total_rows\": \"200\",\"page_data\": [ { \"id\": \"1\",\"lastname\": \"Kingma\",\"detalhes\":\"<a href='/Produto/CadastroProduto' ><button type='button' class='btn btn-primary' ><i class='fa  fa-edit' aria-hidden='true' ></i> </button></a>  <a href='/Produto/CadastroProduto' ><button type='button' class='btn btn-primary' ><i class='fa  fa-eye' aria-hidden='true' ></i> </button></a>\" }]}";

            return View();
        }




        public ActionResult Contact()
        {
            ViewBag.Message = "Contato";

            return View();
        }


        public ActionResult BuscarCadastros()
        {
            ViewBag.Message = "Buscar Cadastros";

            return View();
        }

        public ActionResult CadastroBasico()
        {
            ViewBag.Message = "Buscar Cadastros";

            return View();
        }
    }
}