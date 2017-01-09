using System;

namespace Sistema.Domain.Entities
{
    public class Usuario 
    {
        
        public Guid UsuarioId { get; set; }
        public String Nome { get; set; }
        public String Login { get; set; }
        public String Senha { get; set; }

        public Usuario() {
            UsuarioId = Guid.NewGuid();
        }


    }
}
