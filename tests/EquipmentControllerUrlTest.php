<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EquipmentControllerUrlTest extends WebTestCase
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


    public function testEditEquipmentPage(): void
    {
        $client = static::createClient(array(), array('HTTP_HOST' => self::BASE_URL)) ;
        $crawler = $client->request('GET', '/999/edit');
        $this->assertResponseRedirects();
    }



}
