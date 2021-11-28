<?php

namespace App\Test\Controller\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserControllerTest extends WebTestCase
{
    public function testUpdateUser()
    {
        $client = static::createClient();

        $client->request(
            'PUT',
            '/api/user/2',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
            ],
            '{"name":"test updated"}'
        );

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('user update', $client->getResponse()->getContent());

        $client->request('GET', '/api/user/2');
        $this->assertStringContainsString('"name":"test updated"', $client->getResponse()->getContent());
    }
}