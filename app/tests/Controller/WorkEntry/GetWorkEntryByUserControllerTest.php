<?php

namespace App\Test\Controller\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GetWorkEntryByUserControllerTest extends WebTestCase
{
    public function testWorkEntryUser()
    {
        $client = static::createClient();

        $client->request('GET', '/api/workentry/user/3');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $this->assertStringContainsString('"userId":3', $client->getResponse()->getContent());
    }
}