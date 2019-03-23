<?php

namespace App\Test\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventAdminControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/events/');
        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testAdd()
    {
        $client = static::createClient();

        $client->request('POST', '/admin/events/ajouter-un-evenement');
        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testEdit()
    {
        $client = static::createClient();

        $client->request('POST', '/admin/events/editer/1');
        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testDelete()
    {
        $client = static::createClient();

        $client->request('POST', '/admin/events/delete/1');
        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}