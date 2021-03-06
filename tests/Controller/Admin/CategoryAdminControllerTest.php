<?php

namespace App\Test\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryAdminControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/categorie/');
        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testAdd()
    {
        $client = static::createClient();

        $client->request('POST', '/admin/categorie/ajouter-categorie');
        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testEdit()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/categorie/editer/2');
        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testDelete()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/categorie/delete/2');
        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}