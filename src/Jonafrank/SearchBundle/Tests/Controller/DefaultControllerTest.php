<?php

namespace Jonafrank\SearchBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testSearch()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/search?query=king');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Search Results for: "king"', $client->getResponse()->getContent());
        $this->assertTrue($crawler->filter('.panel')->count() > 0);
    }
}
