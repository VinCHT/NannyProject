<?php

namespace App\Repository;

use App\Entity\Nanny;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Nanny|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nanny|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nanny[]    findAll()
 * @method Nanny[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NannyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nanny::class);
    }

    /**
     * @return Nanny[]
     */
    public function findAllVisible(): array
    {
        return $this->findVisibleQuery()
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Nanny[]
     */
    public function findLatest(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('n')
            ->where('n.occuppe = false');
    }


//    /**
//     * @return Nanny[] Returns an array of Nanny objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nanny
    {
        return $this->createQueryBuilder('n')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
