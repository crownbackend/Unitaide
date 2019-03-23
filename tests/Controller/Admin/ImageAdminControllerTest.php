<?php

namespace App\Test\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ImageAdminControllerTest extends WebTestCase
{
    public function testDelete()
    {
        $client = static::createClient();

        $client->request('DELETE', '/admin/supprimer/images/1');
        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}