<?php

namespace App\Test\Controller\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GetWorkEntryControllerTest extends WebTestCase
{
    public function testWorkEntryUser()
    {
        $client = static::createClient();

        $client->request('GET', '/api/workentry/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}