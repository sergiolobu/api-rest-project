<?php

namespace App\Test\Controller\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DeleteWorkEntryControllerTest extends WebTestCase
{
    public function testRemoveWorkEntry()
    {
        $client = static::createClient();

        $client->request('DELETE', '/api/workentry/1');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}