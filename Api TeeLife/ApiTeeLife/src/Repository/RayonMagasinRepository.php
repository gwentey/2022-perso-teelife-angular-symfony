<?php

namespace App\Repository;

use App\Entity\RayonMagasin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RayonMagasin>
 *
 * @method RayonMagasin|null find($id, $lockMode = null, $lockVersion = null)
 * @method RayonMagasin|null findOneBy(array $criteria, array $orderBy = null)
 * @method RayonMagasin[]    findAll()
 * @method RayonMagasin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RayonMagasinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RayonMagasin::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(RayonMagasin $entity, bool $flush = false): void
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
    public function remove(RayonMagasin $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

//    /**
//     * @return RayonMagasin[] Returns an array of RayonMagasin objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RayonMagasin
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
