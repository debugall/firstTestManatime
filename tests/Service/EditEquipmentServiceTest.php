<?php

namespace App\Tests;

use App\Entity\Equipment;
use App\Service\EditEquipmentService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EditEquipmentServiceTest extends TestCase
{
    public function testSaveEquipment(): void
    {
        $equipment = $this->createMock(Equipment::class);
        $equipment->expects($this->once())->method('setCreatedAt');

        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects($this->once())->method('persist')->with($equipment);
        $em->expects($this->once())->method('flush');

        /** @var EditEquipmentService $editEquipmentService */
        $editEquipmentService = new EditEquipmentService($em);
        $editEquipmentService->saveEquipment($equipment);
    }


    public function testUpdateEquipment(): void
    {
        $equipment = $this->createMock(Equipment::class);
        $equipment->expects($this->once())->method('setUpdatedAt');

        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects($this->once())->method('persist')->with($equipment);
        $em->expects($this->once())->method('flush');

        /** @var EditEquipmentService $editEquipmentService */
        $editEquipmentService = new EditEquipmentService($em);
        $editEquipmentService->updateEquipment($equipment);
    }


    public function testDeteleEquipment(): void
    {
        $equipment = $this->createMock(Equipment::class);
        $equipment->expects($this->once())->method('setDeletedAt');

        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects($this->once())->method('persist');
        $em->expects($this->once())->method('flush');

        /** @var EditEquipmentService $editEquipmentService */
        $editEquipmentService = new EditEquipmentService($em);
        $editEquipmentService->deleteEquipment($equipment);
    }
}
