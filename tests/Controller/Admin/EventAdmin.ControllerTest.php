<?php

namespace App\Test\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventAdminControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/events/');
        $crawler = $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}