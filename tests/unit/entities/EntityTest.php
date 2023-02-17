<?php

declare(strict_types=1);

namespace unit\entities;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Maphpodon\Maphpodon;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class EntityTest extends TestCase
{
    protected function getResponseClient(string $jsonResponse): Maphpodon
    {
        $client = new class extends Client {
            public string $jsonResponse;

            public function get($uri, array $options = []): ResponseInterface
            {
                return new Response(200, [], $this->jsonResponse);
            }
            public function post($uri, array $options = []): ResponseInterface
            {
                return new Response(200, [], $this->jsonResponse);
            }
            public function put($uri, array $options = []): ResponseInterface
            {
                return new Response(200, [], $this->jsonResponse);
            }
            public function delete($uri, array $options = []): ResponseInterface
            {
                return new Response(200, [], $this->jsonResponse);
            }
        };
        $client->jsonResponse = $jsonResponse;

        return new Maphpodon(
            "domain",
            null,
            null,
            "urg",
            null,
            $client,
        );
    }

    public function testImExisting(): void
    {
        $this->assertTrue(true);
    }
}
