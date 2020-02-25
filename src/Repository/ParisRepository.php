<?php

namespace App\Repository;

use App\Entity\Paris;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Paris|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paris|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paris[]    findAll()
 * @method Paris[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paris::class);
    }

    // /**
    //  * @return Paris[] Returns an array of Paris objects
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
    public function findOneBySomeField($value): ?Paris
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByDistrict($borough)
    {
        return $this->createQueryBuilder('c')
            ->where('c.borough = :borough')
            ->setParameter('borough', $borough)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findWhenCheaperThan($price)
    {
        return $this
            ->createQueryBuilder('c')
            ->where('c.costPerDay <= :price')
            ->setParameter('price', $price)
            ->orderBy('c.costPerDay', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function FindBetween($price, $limitPrice)
    {
        return $this
            ->createQueryBuilder('c')
            ->where('c.costPerDay BETWEEN :price AND :limitPrice')
            ->setParameter('price', $price)
            ->setParameter('limitPrice', $limitPrice)
            ->orderBy('c.costPerDay', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findMoreExpensive($price)
    {
        return $this
            ->createQueryBuilder('c')
            ->where('c.costPerDay > :price')
            ->setParameter('price', $price)
            ->orderBy('c.costPerDay', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
}
