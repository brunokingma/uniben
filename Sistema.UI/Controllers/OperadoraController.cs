using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.Text;
namespace Uniben.UI.Controllers
{
    public class OperadoraController : Controller
    {
        // GET: Operadora
        public ActionResult Index()
        {
            return View();
        }


     /*
        [HttpGet]
        public ActionResult RetornaCnpj(String id)
        {
            var DadosCnpj = Servicos.RetornaDadosCnpj(id);
            byte[] bytes = Encoding.Default.GetBytes(DadosCnpj);
            DadosCnpj = Encoding.UTF8.GetString(bytes);
            return Json(DadosCnpj,JsonRequestBehavior.AllowGet);
        }

    */

        public ActionResult CadastroOperadora()
        {
            return View("CadastroOperadora");
        }


    }
}