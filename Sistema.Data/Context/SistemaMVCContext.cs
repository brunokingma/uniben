using Sistema.Domain.Entities;
using System;
using System.Data.Entity;
using System.Data.Entity.ModelConfiguration.Conventions;

namespace Sistema.Data.Context
{
    class SistemaMVCContext: DbContext
    {

        public SistemaMVCContext() : base("Sistema") {

        }

        public DbSet<Endereco> Endereco { get; set; }
        public DbSet<Empresa> Empresa { get; set; }

        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {

            //configuração do framework
            modelBuilder.Conventions.Remove<PluralizingTableNameConvention>();
            modelBuilder.Conventions.Remove<OneToManyCascadeDeleteConvention>();
            modelBuilder.Conventions.Remove<ManyToManyCascadeDeleteConvention>();

            //configuração das tabelas
            modelBuilder.Properties().Where(p => p.Name == p.ReflectedType.Name + "Id").Configure(p => p.IsKey());
            modelBuilder.Properties<string>().Configure(p => p.HasColumnType("varchar"));
            modelBuilder.Properties<string>().Configure(p => p.HasMaxLength(100));

            base.OnModelCreating(modelBuilder);
        }


        public override int SaveChanges()
        {
            foreach (var entry in ChangeTracker.Entries().Where(Entry => Entry.Entity.GetType().GetProperty()))
            {

            }
            return base.SaveChanges();
        }




    }
}
