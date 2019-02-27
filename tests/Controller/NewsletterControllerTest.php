<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewsletterControllerTest extends WebTestCase
{
    public function testAddMail()
    {
        $client = static::createClient();

        $client->request('POST', '/newsletter-register', ['name' => 'Bouchoucha', 'email' => 'john@doe.fr']);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}