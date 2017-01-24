
using System;
using System.Net;

namespace CrossCuttingService
{
    public static class WSService
    {

        public static String RetornaDadosCnpj(String cnpj)
        {

            var url = "https://www.receitaws.com.br/v1/cnpj/" + cnpj;
            var cliente = new WebClient();
            var conteudo = cliente.DownloadString(url);
            return conteudo;

        }


        public static String RetornaDadosCep(String cep)
        {

            var url = "https://viacep.com.br/ws/" + cep + "/json/";
            var cliente = new WebClient();
            var conteudo = cliente.DownloadString(url);
            return conteudo;

        }



    }
}
