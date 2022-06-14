<?php

namespace App\Repository;

use App\Entity\InteractionsPersonnage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InteractionsPersonnage>
 *
 * @method InteractionsPersonnage|null find($id, $lockMode = null, $lockVersion = null)
 * @method InteractionsPersonnage|null findOneBy(array $criteria, array $orderBy = null)
 * @method InteractionsPersonnage[]    findAll()
 * @method InteractionsPersonnage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InteractionsPersonnageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InteractionsPersonnage::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(InteractionsPersonnage $entity, bool $flush = false): void
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
    public function remove(InteractionsPersonnage $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

//    /**
//     * @return InteractionsPersonnage[] Returns an array of InteractionsPersonnage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InteractionsPersonnage
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
