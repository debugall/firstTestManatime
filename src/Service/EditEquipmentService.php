<?php


namespace App\Service;


use App\Entity\Equipment;
use Doctrine\ORM\EntityManagerInterface;

class EditEquipmentService
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function saveEquipment(Equipment $equipment)
    {
        $equipment->setCreatedAt(new \DateTime());
        $this->em->persist($equipment);
        $this->em->flush();
    }

    public function updateEquipment(Equipment $equipment)
    {
        $equipment->setUpdatedAt(new \DateTime());
        $this->em->persist($equipment);
        $this->em->flush();
    }

    public function deleteEquipment(Equipment $equipment)
    {
        if (!$equipment->getDeletedAt()) {
            $equipment->setDeletedAt(new \DateTime());
            $this->em->persist($equipment);
            $this->em->flush();
        }
    }
}