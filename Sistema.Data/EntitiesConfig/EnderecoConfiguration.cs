using System.ComponentModel.DataAnnotations.Schema;
using System.Data.Entity.ModelConfiguration;
using Sistema.Domain.Entities;

namespace Sistema.Data.EntitiesConfig
{
    public class EnderecoConfiguration : EntityTypeConfiguration<Endereco>
    {

        public EnderecoConfiguration() {
           
            HasKey(e => e.EnderecoId);           
            Property(e => e.EnderecoId).HasDatabaseGeneratedOption(DatabaseGeneratedOption.Identity);
            Property(e => e.logradouro).HasMaxLength(250);
            Property(e => e.cep).HasMaxLength(9);
            Property(e => e.cidade).HasMaxLength(150);
            Property(e => e.numero).HasMaxLength(10);
            Property(e => e.estado).HasMaxLength(2);
            Property(e => e.complemento).HasMaxLength(300);
            Property(e => e.bairro).HasMaxLength(100);

        }
    }
}
