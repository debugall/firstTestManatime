<?php

namespace App\Tests;

use App\DataFixtures\EquipmentFixtures;
use App\Entity\Equipment;
use App\Repository\EquipmentRepository;
use App\Service\EditEquipmentService;
use App\Service\EquipmentService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EditEquipmentServiceFuncTest extends FixtureAwareTestCase
{


    public function setUp() : void
    {
        parent::setUp();
        $this->addFixture(new EquipmentFixtures());
        $this->executeFixtures();
    }

    public function testsaveEquipment()
    {
        $kernel = self::$kernel;
        $container = self::$container;
        /** @var EditEquipmentService $editEquipmentService */
        $editEquipmentService = $container->get(EditEquipmentService::class);
        $eqpt = new Equipment();
        $eqpt->setName('E1 test');
        $eqpt->setDescription('D1 test');
        $eqpt->setNumber('N1 test');
        $editEquipmentService->saveEquipment($eqpt);

        /** @var EquipmentService $equipmentService */
        $equipmentService = $container->get(EquipmentService::class);
        $equipments = $equipmentService->getAllEquipments();

        $this->assertCount(2, $equipments);

    }


    public function testupdateEquipment()
    {
        $kernel = self::$kernel;
        $container = self::$container;

        /** @var EquipmentService $equipmentService */
        $equipmentService = $container->get(EquipmentService::class);
        $equipments = $equipmentService->getAllEquipments();
        $eqptToUpdate = $equipments[0];
        $eqptToUpdate->setName('new');

        /** @var EditEquipmentService $editEquipmentService */
        $editEquipmentService = $container->get(EditEquipmentService::class);
        $editEquipmentService->updateEquipment($eqptToUpdate);

        $equipments = $equipmentService->getAllEquipments();
        $eqptUpdated = $equipments[0];
        $this->assertEquals('new', $eqptUpdated->getName());

    }

}
