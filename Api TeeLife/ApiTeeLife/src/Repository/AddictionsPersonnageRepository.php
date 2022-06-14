<?php

namespace App\Repository;

use App\Entity\AddictionsPersonnage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AddictionsPersonnage>
 *
 * @method AddictionsPersonnage|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddictionsPersonnage|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddictionsPersonnage[]    findAll()
 * @method AddictionsPersonnage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddictionsPersonnageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AddictionsPersonnage::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(AddictionsPersonnage $entity, bool $flush = false): void
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
    public function remove(AddictionsPersonnage $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

//    /**
//     * @return AddictionsPersonnage[] Returns an array of AddictionsPersonnage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AddictionsPersonnage
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
