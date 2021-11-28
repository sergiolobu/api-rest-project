<?php

namespace App\Test\Controller\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DatesWorkEntryTest extends WebTestCase
{
    public function testIfDateStartIsLessThanDateEndReturn500()
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
            '{"user_id" : "1","startDate":"12-11-2012", "endDate":"01-01-2012"}'
        );

        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Error, WorkEntry not created (Error (End Date is less than Start Date)', $client->getResponse()->getContent());
    }
}