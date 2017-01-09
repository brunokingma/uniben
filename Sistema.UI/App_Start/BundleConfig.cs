using System.Web;
using System.Web.Optimization;

namespace Sistema.UI
{
    public class BundleConfig
    {
        // For more information on bundling, visit http://go.microsoft.com/fwlink/?LinkId=301862
        public static void RegisterBundles(BundleCollection bundles)
        {
            bundles.Add(new ScriptBundle("~/bundles/jquery").Include(
                        "~/Scripts/jquery-{version}.js"));

            bundles.Add(new ScriptBundle("~/bundles/jqueryval").Include(
                        "~/Scripts/jquery.validate*"));

            // Use the development version of Modernizr to develop with and learn from. Then, when you're
            // ready for production, use the build tool at http://modernizr.com to pick only the tests you need.
            bundles.Add(new ScriptBundle("~/bundles/modernizr").Include(
                        "~/Scripts/modernizr-*"));

            bundles.Add(new ScriptBundle("~/bundles/bootstrap").Include(
                      "~/Scripts/bootstrap.js",
                      "~/Scripts/respond.js"));

            bundles.Add(new ScriptBundle("~/bundles/grid").Include(
                    "~/Scripts/jquery.bs_grid.js",
                    "~/Scripts/localization/en.min.js"));



            bundles.Add(new ScriptBundle("~/bundles/pagination").Include(
                        "~/Scripts/localization/en3.js", "~/Scripts/jquery.bs_pagination.js"));


            bundles.Add(new ScriptBundle("~/bundles/jui_filter").Include(
                      "~/Scripts/localization/en4.js", "~/Scripts/jquery.jui_filter_rules.js"));


            bundles.Add(new ScriptBundle("~/bundles/sistema").Include(
                        "~/Scripts/sistema.js"));


            bundles.Add(new ScriptBundle("~/bundles/jquery-ui").Include(
                        "~/Scripts/jquery-ui.min.js"));


            bundles.Add(new ScriptBundle("~/bundles/mascaras").Include(
                        "~/Scripts/jquery.maskedinput.min.js"));


            bundles.Add(new ScriptBundle("~/bundles/fileinput").Include(
                        "~/Scripts/fileinput.js", "~/Scripts/locale/pt-BR.js"));


            bundles.Add(new ScriptBundle("~/bundles/multiselect").Include(
                        "~/Scripts/bootstrap-multiselect.js"));



            bundles.Add(new StyleBundle("~/Content/css").Include(
                      "~/Content/bootstrap.css",
                      "~/Content/font-awesome.css",
                      "~/Content/jquery.bs_pagination.min.css",
                      "~/Content/site.css",
                      "~/Content/jquery-ui.css",
                      "~/Content/bootstrap-multiselect.css",
                      "~/Content/fileinput.css"));
        }
    }
}
