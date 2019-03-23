<?php

namespace App\Test\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeAdminControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/');
        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowIdea()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/idea-box/show/1');
        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}