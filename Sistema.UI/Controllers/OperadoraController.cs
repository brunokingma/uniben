using System.Web.Mvc;

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