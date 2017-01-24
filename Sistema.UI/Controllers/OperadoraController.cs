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


    

    

        public ActionResult CadastroOperadora()
        {
            return View("CadastroOperadora");
        }


    }
}