using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
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