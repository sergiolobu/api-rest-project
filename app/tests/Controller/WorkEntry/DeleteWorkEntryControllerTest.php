<?php

namespace App\Test\Controller\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserControllerTest extends WebTestCase
{
    public function testRemoveUser()
    {
        $client = static::createClient();

        $client->request('DELETE', '/api/user/1');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}