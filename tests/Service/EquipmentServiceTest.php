<?php

namespace App\Tests;

use App\Repository\EquipmentRepository;
use App\Service\EquipmentService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EquipmentServiceTest extends TestCase
{
    public function testGetAllEquipments(): void
    {
        $equipmentRepo = $this->createMock(EquipmentRepository::class);
        $em = $this->createMock(EntityManagerInterface::class);

        $em->expects($this->once())->method('getRepository')->willReturn($equipmentRepo);
        $equipmentRepo->expects($this->once())->method('getNotDeletedEquipments');

        /** @var EquipmentService $equipmentService */
        $equipmentService = new EquipmentService($em);
        $equipmentService->getAllEquipments();
    }
}
