<?php

namespace App\Test\Controller\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateUserControllerTest extends WebTestCase
{
    public function testCreateUser()
    {
        $client = static::createClient();

        $randNumber = rand();

        $client->request(
            'POST',
            '/api/user',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
            ],
            '{"name":"test", "email":"test+'.$randNumber.'@gmail.com"}'
        );

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
    }
}