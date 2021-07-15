<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EquipmentControllerTest extends WebTestCase
{
    const BASE_URL = 'localhost:8000';

    public function testIndexPage(): void
    {
        $client = static::createClient(array(), array('HTTP_HOST' => self::BASE_URL)) ;
        $crawler = $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
    }


    public function testCreateEquipmentPage(): void
    {
        $client = static::createClient(array(), array('HTTP_HOST' => self::BASE_URL)) ;
        $crawler = $client->request('GET', '/new');
        $this->assertResponseIsSuccessful();
    }



}
