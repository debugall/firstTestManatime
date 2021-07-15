<?php


namespace App\Service;


use App\Entity\Equipment;
use App\Repository\EquipmentRepository;
use Doctrine\ORM\EntityManagerInterface;

class EquipmentService
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAllEquipments()
    {
        /** @var EquipmentRepository $equipmentRepo */
        $equipmentRepo = $this->em->getRepository(Equipment::class);
        return $equipmentRepo->getNotDeletedEquipments();
    }


}