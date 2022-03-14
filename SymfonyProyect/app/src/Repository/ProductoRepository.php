<?php

namespace App\Repository;

use App\Entity\Producto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Producto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Producto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Producto[]    findAll()
 * @method Producto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Producto::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Producto $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Producto $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function BuscarProducto(int $limit, string $nom)
    {

        $qb = $this->createQueryBuilder('p');
        $result = $qb->select('p.id', 'p.nombre', 'p.precio_unitario', 'p.stock')
            ->where( $qb->expr()->like('p.nombre', $qb->expr()->literal( $nom . '%')) )
            ->setMaxResults($limit)
            ->getQuery();

        return $result->getResult();

    }

    public function BuscarUnProducto(string $id)
    {

        $qb = $this->createQueryBuilder('p');
        $result = $qb->select('p.id')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $result->getResult();

    }

    // /* *
    //  * @return Producto[] Returns an array of Producto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Producto
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
