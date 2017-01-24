using Sistema.Data.EntiteConfing;
using Sistema.Domain.Entities;
using System;
using System.Data.Entity;
using System.Data.Entity.ModelConfiguration.Conventions;
using System.Linq;

namespace Sistema.Data.Context
{
   public class SistemaMVCContext: DbContext
    {

        public SistemaMVCContext() : base("Sistema") {
          
        }

                public DbSet<Endereco> Endereco { get; set; }
                public DbSet<Empresa> Empresa { get; set; }
                public DbSet<Pessoa> Pessoa { get; set; }

       
                protected override void OnModelCreating(DbModelBuilder modelBuilder)
                {

                    //configuração do framework
                    modelBuilder.Conventions.Remove<PluralizingTableNameConvention>();
                    modelBuilder.Conventions.Remove<OneToManyCascadeDeleteConvention>();
                    modelBuilder.Conventions.Remove<ManyToManyCascadeDeleteConvention>();

                    //configuração de cada tabela
                    modelBuilder.Configurations.Add(new PessoaConfiguration());
                    modelBuilder.Configurations.Add(new EmpresaConfiguration());
                    modelBuilder.Configurations.Add(new EnderecoConfiguration());

                    //configuração das tabelas padrão
                    modelBuilder.Properties().Where(p => p.Name == p.ReflectedType.Name + "Id").Configure(p => p.IsKey());
                    modelBuilder.Properties<string>().Configure(p => p.HasColumnType("varchar"));
                    modelBuilder.Properties<string>().Configure(p => p.HasMaxLength(100));           


                    base.OnModelCreating(modelBuilder);
                }


                public override int SaveChanges()
                {
                    foreach (var entry in ChangeTracker.Entries().Where(Entry => Entry.Entity.GetType().GetProperty("DataCadastro") != null))
                    {
                        if (entry.State == EntityState.Added) {
                            entry.Property("DataCadastro").CurrentValue = DateTime.Now;
                        }

                        if (entry.State == EntityState.Modified)
                        {
                            entry.Property("DataCadastro").CurrentValue = false;
                        }

                    }
                    return base.SaveChanges();
                }
                



    }
}
