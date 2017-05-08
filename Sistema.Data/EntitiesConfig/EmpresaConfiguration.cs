using System.ComponentModel.DataAnnotations.Schema;
using System.Data.Entity.ModelConfiguration;
using Sistema.Domain.Entities;

namespace Sistema.Data.EntitiesConfig
{
    public class EmpresaConfiguration : EntityTypeConfiguration<Empresa>
    {
        public EmpresaConfiguration() {

            HasKey(c => c.EmpresaId);
            Property(c => c.EmpresaId).HasDatabaseGeneratedOption(DatabaseGeneratedOption.Identity);
            Property(c => c.Nome).HasMaxLength(255);
            Property(c => c.NomeFantasia).HasMaxLength(255);
            Property(c => c.Situacao).HasMaxLength(150);
            Property(c => c.NaturezaJuridica).HasMaxLength(255);
            Property(c => c.CNPJ).HasMaxLength(20);
            Property(c => c.Codigo).HasMaxLength(20);
            Property(c => c.AtividadePrincipal).HasMaxLength(255);
            Property(c => c.Abertura).HasMaxLength(20);

            // MAPEAMENTO DE MUITOS PARA MUITOS
            HasMany(c => c.Enderecos)
                .WithMany()
                .Map(me =>
                {
                    me.MapLeftKey("EmpresaId");
                    me.MapRightKey("EnderecoId");
                    me.ToTable("EmpresaEndereco");
                });
        
        }

    }
}
