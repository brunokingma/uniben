using Sistema.Domain.Interfaces;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Linq.Expressions;
using Sistema.Data.Context;
using System.Data.Entity;
using System.Data.Entity.Validation;

namespace Sistema.Data.Repositories
{
    public class BaseRepository<TEntity> : IBaseRepository<TEntity> where TEntity : class
    {


        protected readonly SistemaMVCContext Context;
        protected DbSet<TEntity> DbSet;


        public BaseRepository() {
            Context = new SistemaMVCContext();
            DbSet = Context.Set<TEntity>();
        }


        public virtual void Add(TEntity obj)
        {
           
            try
            {
                DbSet.Add(obj);
                Context.SaveChanges();
            }
            catch (DbEntityValidationException e)
            {
                foreach (var eve in e.EntityValidationErrors)
                {
                    Console.WriteLine("Entidade:", eve.Entry.Entity.GetType().Name, eve.Entry.State);
                    foreach (var ve in eve.ValidationErrors)
                    {
                        Console.WriteLine("- Property: \"{0}\", Error: \"{1}\"", ve.PropertyName, ve.ErrorMessage);
                    }
                }
                throw;
            }
        }

        public void Dispose()
        {
            Context.Dispose();
            GC.SuppressFinalize(this);
        }

        public virtual IEnumerable<TEntity> Find(Expression<Func<TEntity, bool>> predicate)
        {
           return DbSet.Where(predicate);

        }

        public virtual IEnumerable<TEntity> GetAll(int skip, int take)
        {
            return DbSet.ToList().Skip(skip).Take(take);
        }

        public virtual IEnumerable<TEntity> GetAll()
        {
            return DbSet.ToList();
        }

        public virtual TEntity GetById(int id)
        {
            return DbSet.Find(id);
        }

        public virtual void Remove(TEntity obj)
        {
            DbSet.Remove(obj);
            Context.SaveChanges();
        }

        public virtual void Update(TEntity obj)
        {
            var entry = Context.Entry(obj);
            DbSet.Attach(obj);
            entry.State = EntityState.Modified;
            Context.SaveChanges();
        }
    }
}
