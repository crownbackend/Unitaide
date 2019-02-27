<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AboutControllerTest extends WebTestCase
{
    public function  testAbout()
    {
        $client = static::createClient();

        $client->request('GET', '/qui-sommes-nous');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}