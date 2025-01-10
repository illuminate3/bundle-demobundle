<?php

namespace App\Bundles\DemoBundle\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DemoControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/demo/test');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('body', 'Demo Bundle is working!');
    }

    public function testResponseIsSuccessful(): void
    {
        $client = static::createClient();
        $client->request('GET', '/demo/test');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testResponseContent(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/demo/test');

        // Test that the response contains our expected text
        $this->assertStringContainsString(
            'Demo Bundle is working!',
            $client->getResponse()->getContent()
        );
    }

    public function testInvalidRoute(): void
    {
        $client = static::createClient();
        $client->request('GET', '/demo/nonexistent');

        $this->assertResponseStatusCodeSame(404);
    }
}
