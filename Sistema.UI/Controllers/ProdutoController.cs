using System.Web.Mvc;

namespace Uniben.UI.Controllers
{
    public class ProdutoController : Controller
    {
        public ActionResult CadastroProduto()
        {
            return View("CadastroProduto");
        }
    }
}