<?php

namespace App\DataFixtures;

use App\Entity\Equipment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EquipmentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $eqpt = new Equipment();
        $eqpt->setName('E1');
        $eqpt->setDescription('D1');
        $eqpt->setNumber('N1');
        $eqpt->setCreatedAt(new \DateTime());
        $eqpt->setUpdatedAt(new \DateTime());

        $manager->persist($eqpt);
        $manager->flush();
    }
}
