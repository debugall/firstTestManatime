<?php

namespace App\Repository;

use App\Entity\Equipment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Equipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipment[]    findAll()
 * @method Equipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipment::class);
    }

    /**
     * @param string $number
     * @return Equipment
     */
    public function getEquipmentBySerial($number)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.number = :number')->setParameter('number', $number)
            ->getQuery()->getOneOrNullResult()
            ;
    }

    /**
     * @return Equipment[]
     */
    public function getNotDeletedEquipments()
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.deletedAt is NULL')
            ->getQuery()->getResult()
        ;
    }

}
