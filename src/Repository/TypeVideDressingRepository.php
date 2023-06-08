<?php

namespace App\Repository;

use App\Entity\TypeVideDressing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeVideDressing>
 *
 * @method TypeVideDressing|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeVideDressing|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeVideDressing[]    findAll()
 * @method TypeVideDressing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeVideDressingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeVideDressing::class);
    }

    public function save(TypeVideDressing $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TypeVideDressing $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TypeVideDressing[] Returns an array of TypeVideDressing objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeVideDressing
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
