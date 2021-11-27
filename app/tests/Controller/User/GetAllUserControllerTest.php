<?php

namespace App\Test\Controller\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GetAllUserControllerTest extends WebTestCase
{
    public function testShowUsers()
    {
        $client = static::createClient();

        $client->request('GET', '/api/users');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('"name":"test","email":"test+1234@gmail.com"', $client->getResponse()->getContent());
    }
}