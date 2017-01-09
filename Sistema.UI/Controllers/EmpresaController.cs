using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace Uniben.UI.Controllers
{
    public class EmpresaController : Controller
    {
        // GET: Empresa
        public ActionResult CadastroEmpresa()
        {
            return View();
        }
    }
}