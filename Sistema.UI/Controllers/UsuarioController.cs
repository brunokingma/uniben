using System.Linq;
using System.Web.Mvc;


namespace Uniben.UI.Controllers
{
    public class UsuarioController : Controller
    {
        // GET: Usuario
        public ActionResult Index()
        {
            return View();
        }


        public ActionResult Login()
        {
            return PartialView("Login");
        }


  /* 
        [HttpPost]
        [ValidateAntiForgeryToken]
     public ActionResult Login(Usuario u)
        {

            if (ModelState.IsValid)
            {

                using (DesenvolvimentoEntities dc = new DesenvolvimentoEntities())
                {
                    var senha  = MD5.CriptografiaMD5(u.Senha);

                    var v = dc.Usuario.Where(a => a.Login.Equals(u.Login) && a.Senha.Equals(senha)).FirstOrDefault();

                    if (v != null)
                    {
                        Session["id"] = v.Id.ToString();
                        Session["nome"] = v.Nome.ToString();
                        return RedirectToAction("Poslogin");
                    }
                    else
                    {
                        return RedirectToAction("Login", "Usuario");
                    }
                }

            }
            return View(u);
        }
        */


        public ActionResult Poslogin()
        {
            if (Session["nome"] != null){
                return RedirectToAction("Index", "Home");
            }else{
                return PartialView("Login");
            }
        }


        public ActionResult Logout()
        {
            Session.Clear();
            Session.Abandon();
            Session.RemoveAll();

            return RedirectToAction("Login", "Usuario");

        }



    }

}
 