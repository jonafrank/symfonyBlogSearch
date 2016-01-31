<?php

namespace Jonafrank\SearchBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testElasticSearch()
    {
        $client = static::createClient(array(
            'environment' => 'elastic_test'
        ));
        $crawler = $client->request('GET', '/search?query=Dormouse');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Search Results for: "Dormouse"', $client->getResponse()->getContent());
        $this->assertTrue($crawler->filter('.panel')->count() > 0);
    }

    public function testDoctrineSearch()
    {
        $client = static::createClient(array(
            'environment' => 'doctrine_test'
        ));
        $crawler = $client->request('GET', '/search?query=Dormouse');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Search Results for: "Dormouse"', $client->getResponse()->getContent());
        $this->assertTrue($crawler->filter('.panel')->count() > 0);
    }
}
