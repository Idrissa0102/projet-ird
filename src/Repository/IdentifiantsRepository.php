<?php

namespace App\Repository;

use App\Entity\Identifiants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Identifiants|null find($id, $lockMode = null, $lockVersion = null)
 * @method Identifiants|null findOneBy(array $criteria, array $orderBy = null)
 * @method Identifiants[]    findAll()
 * @method Identifiants[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdentifiantsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Identifiants::class);
    }

    // /**
    //  * @return Identifiants[] Returns an array of Identifiants objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Identifiants
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
