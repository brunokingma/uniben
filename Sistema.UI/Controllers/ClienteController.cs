using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.Text;

namespace Uniben.UI.Controllers
{
    public class ClienteController : Controller
    {
        // GET: Cliente
        public ActionResult Index()
        {
            return View();
        }
/*
        [HttpGet]
        public ActionResult RetornaCep(String id)
        {
            var Dados = Servicos.RetornaDadosCep(id);
            byte[] bytes = Encoding.Default.GetBytes(Dados);
            Dados = Encoding.UTF8.GetString(bytes);
            return Json(Dados, JsonRequestBehavior.AllowGet);
        }

    */

        public ActionResult CadastroCliente()
        {
            return View("CadastroCliente");
        }

        public ActionResult CadastroDependente()
        {
            return View("CadastroDependente");
        }


        public ActionResult DetalheCliente()
        {
            return View();
        }


        public ActionResult Anexo()
        {
            return View();
        }


    }
}