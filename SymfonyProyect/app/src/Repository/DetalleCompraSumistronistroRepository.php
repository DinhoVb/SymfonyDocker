<?php

namespace App\Repository;

use App\Entity\CompraSuministro;
use App\Entity\DetalleCompraSumistronistro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @method DetalleCompraSumistronistro|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetalleCompraSumistronistro|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetalleCompraSumistronistro[]    findAll()
 * @method DetalleCompraSumistronistro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetalleCompraSumistronistroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetalleCompraSumistronistro::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(DetalleCompraSumistronistro $entity, bool $flush = true): void
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
    public function remove(DetalleCompraSumistronistro $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function BuscarDetalles($id)
    {
        return $this->createQueryBuilder('d')
            ->Where('d.compra = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
