<?php

namespace App\Test\Controller\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GetUserControllerTest extends WebTestCase
{
    public function testShowUser()
    {
        $client = static::createClient();

        $client->request('GET', '/api/user/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}