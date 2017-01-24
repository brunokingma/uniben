using Sistema.Domain.Entities;
using System.ComponentModel.DataAnnotations.Schema;
using System.Data.Entity.ModelConfiguration;

namespace Sistema.Data.EntiteConfing
{
    public class PessoaConfiguration: EntityTypeConfiguration<Pessoa>
    {


        public PessoaConfiguration()
        {
            
            HasKey(p => p.PessoaId);
            Property(p => p.PessoaId).HasDatabaseGeneratedOption(DatabaseGeneratedOption.Identity); 
            Property(p => p.Nome).HasMaxLength(200);
            Property(p => p.Celular).HasMaxLength(200);
            Property(p => p.Telefone).HasMaxLength(200);
            Property(p => p.Naturalidade).HasMaxLength(200);
            Property(p => p.Sexo).HasMaxLength(200);
            Property(p => p.Pai).HasMaxLength(200);
            Property(p => p.Mae).HasMaxLength(200);
            Property(p => p.Email).HasMaxLength(200);
            Property(p => p.Ativo);
            Property(p => p.DataCadastro);
            Property(p => p.CartaoSUS).HasMaxLength(40); ;
            Property(p => p.DataCadastro);
      

            // MAPEAMENTO DE MUITOS PARA MUITOS
            HasMany(p => p.Enderecos)
                .WithMany()
                .Map(me =>
                {
            me.MapLeftKey("PessoaId");
            me.MapRightKey("EnderecoId");
            me.ToTable("PessoaEndereco");
                });
           
        }
    }
}
