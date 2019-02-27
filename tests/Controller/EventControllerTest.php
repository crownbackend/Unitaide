<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventControllerTest extends WebTestCase
{
    public function testEvent()
    {
        $client = static::createClient();

        $client->request('GET', '/evenements');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}