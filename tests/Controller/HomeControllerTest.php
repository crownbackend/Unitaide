<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testNewIdea()
    {
        $client = static::createClient();

        $client->request('POST', '/une-idee-a-nous-paratger', [
            'name' => 'belha',
            'telephone' => 02,
            'email' => 'nabile333@live.fr',
            'idea' => 'lorem ipsum'
        ]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}