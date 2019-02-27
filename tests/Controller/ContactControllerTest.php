<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testContact()
    {
        $client = static::createClient();

        $client->request('GET', '/contact');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}