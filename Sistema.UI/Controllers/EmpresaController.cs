using CrossCuttingService;
using Newtonsoft.Json;
using Sistema.Aplication;
using Sistema.Aplication.ViewModels;
using Sistema.Data.Context;
using Sistema.Domain.Entities;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Text;
using System.Web;
using System.Web.Mvc;

namespace Uniben.UI.Controllers
{
    public class EmpresaController : Controller
    {

        private readonly EmpresaAppService _empresaAppService = new Sistema.Aplication.EmpresaAppService();
        private String retorno;


        // GET: Empresa
        public ActionResult CadastroEmpresa()
        {
            return View();
        }


        // GET: Empresa
        public ActionResult BuscaEmpresa()
        {
            return View();
        }

        // GET: Empresa
        public JsonResult Listar(String nome)
        {
            var empresas = _empresaAppService.ObterTodosComEnderecoJson(nome);
            var json = JsonConvert.SerializeObject(empresas);
            return Json(json, JsonRequestBehavior.AllowGet); 
        }

        // GET: Empresa/Details/id
        public ActionResult Details(int id)
        {
            if (id.Equals(""))
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }

            var emv = _empresaAppService.ObterPorId(id);

            if (emv == null)
            {
                return HttpNotFound();
            }
            return View(emv);
        }


        // GET: Empresa/Remove/id
        public ActionResult Remove(int id)
        {
            return View();
        }

        [HttpGet]
        public JsonResult RetornaCnpj(String id)
        {
            var DadosCnpj = WSService.RetornaDadosCnpj(id);
            byte[] bytes = Encoding.Default.GetBytes(DadosCnpj);
            DadosCnpj = Encoding.UTF8.GetString(bytes);
            return Json(DadosCnpj, JsonRequestBehavior.AllowGet);
        }


        [HttpGet]
        public JsonResult RetornaEnderecoPorCEP(String id)
        {
            var DadosCnpj = WSService.RetornaDadosCnpj(id);
            byte[] bytes = Encoding.Default.GetBytes(DadosCnpj);
            DadosCnpj = Encoding.UTF8.GetString(bytes);
            return Json(DadosCnpj, JsonRequestBehavior.AllowGet);
        }


        // POST: Empresa/Add
        [HttpPost]
        public JsonResult Add(EmpresaEnderecoViewModel empresaEnderecoViewModel)
        {

            if (ModelState.IsValid)
            {
                _empresaAppService.Adicionar(empresaEnderecoViewModel);
                retorno = "{\"retorno\":\"true\"}";
            }
            else
            {
                retorno = "{\"retorno\":\"false\"}";
            }
            return Json(retorno, JsonRequestBehavior.AllowGet);
        }


        // GET: Empresa/Update
        public ActionResult Update()
        {
            return View();
        }

        // GET: Empresa/Edit
        public ActionResult Edit()
        {
            return View();
        }

    }
}