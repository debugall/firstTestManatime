<?php

namespace App\Tests;

use App\Entity\Equipment;
use App\Repository\EquipmentRepository;
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

        $equipmentRepo = $this->createMock(EquipmentRepository::class);
        $equipmentRepo->expects($this->once())->method('getEquipmentBySerial')->willReturn(null);

        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects($this->once())->method('getRepository')->willReturn($equipmentRepo);
        $em->expects($this->once())->method('persist')->with($equipment);
        $em->expects($this->once())->method('flush');

        /** @var EditEquipmentService $editEquipmentService */
        $editEquipmentService = new EditEquipmentService($em);
        $editEquipmentService->saveEquipment($equipment);
    }


    public function testSaveEquipmentWithExistingSerialNumber(): void
    {
        $equipmentExit = $this->createMock(Equipment::class);

        $equipment = $this->createMock(Equipment::class);

        $equipmentRepo = $this->createMock(EquipmentRepository::class);
        $equipmentRepo->expects($this->once())->method('getEquipmentBySerial')->willReturn($equipmentExit);

        $em = $this->createMock(EntityManagerInterface::class);
        $em->expects($this->once())->method('getRepository')->willReturn($equipmentRepo);

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

    public function testDeteleAlreadyDeletedEquipment(): void
    {
        $equipment = $this->createMock(Equipment::class);
        $equipment->expects($this->once())->method('getDeletedAt')->willReturn(new \DateTime());

        $em = $this->createMock(EntityManagerInterface::class);

        /** @var EditEquipmentService $editEquipmentService */
        $editEquipmentService = new EditEquipmentService($em);
        $editEquipmentService->deleteEquipment($equipment);
    }
}
