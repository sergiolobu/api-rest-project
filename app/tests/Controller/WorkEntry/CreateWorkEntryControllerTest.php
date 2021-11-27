<?php

namespace App\Test\Controller\WorkEntry;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateWorkEntryControllerTest extends WebTestCase
{
    public function testCreateWorkEntry()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/workentry',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
            ],
            '{"user_id":"1", "startDate":"12-11-2012", "endDate":"12-12-2012" }'
        );

        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
    }
}