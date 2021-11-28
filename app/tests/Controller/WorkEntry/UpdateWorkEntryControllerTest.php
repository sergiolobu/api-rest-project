<?php

namespace App\Test\Controller\WorkEntry;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UpdateWorkEntryControllerTest extends WebTestCase
{
    public function testUpdateWorkEntry()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/api/workentry/1',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
            ],
            '{"startDate":"01-01-2001"}'
        );

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());

        $client->request('GET', '/api/workentry/1');
        $this->assertStringContainsString('"startDate":"2001-01-01 00:00:00"', $client->getResponse()->getContent());
    }
}