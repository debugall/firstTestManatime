<?php

namespace App\Tests;

use App\DataFixtures\EquipmentFixtures;
use App\Repository\EquipmentRepository;
use App\Service\EquipmentService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EquipmentServiceFuncTest extends FixtureAwareTestCase
{


    public function setUp() : void
    {
        parent::setUp();
        $this->addFixture(new EquipmentFixtures());
        $this->executeFixtures();
    }

    public function testgetAllEquipment()
    {
        $kernel = self::$kernel;
        $container = self::$container;
        /** @var EquipmentService $equipmentService */
        $equipmentService = $container->get(EquipmentService::class);
        $equipments = $equipmentService->getAllEquipments();
        $this->assertCount(1, $equipments);

    }

}
