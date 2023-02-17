<?php

declare(strict_types=1);

namespace unit;

use PHPUnit\Framework\TestCase;
use Maphpodon\Maphpodon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

final class MaphpodonTest extends TestCase
{
    public function testGet(): void
    {
        $client = new class extends Client {
            public function get($uri, array $options = []): ResponseInterface
            {
                $expected = [
                    "headers" => ["Authorization" => "Bearer token"],
                    "query" => ["foo" => "bar"],
                ];
                if ($uri == "something/get" && $options == $expected) {
                    return new Response(200, [], '{"good":"stuff"}');
                }
                return new Response(404, [], '{}');
            }
        };
        $masto = new Maphpodon(
            "any",
            "key",
            "secret",
            "token",
            null,
            $client,
        );
        $response = $masto->get("something/get", ["foo" => "bar"]);
        $this->assertEquals("stuff", $response->good);
    }

    public function testPost(): void
    {
        $client = new class extends Client {
            public function post($uri, array $options = []): ResponseInterface
            {
                $expected = [
                    "headers" => ["Authorization" => "Bearer token"],
                    "json" => ["foo" => "bar"],
                ];
                if ($uri == "something/get" && $options == $expected) {
                    return new Response(200, [], '{"good":"stuff"}');
                }
                return new Response(404, [], '{}');
            }
        };
        $masto = new Maphpodon(
            "any",
            "key",
            "secret",
            "token",
            null,
            $client,
        );
        $response = $masto->post("something/get", ["foo" => "bar"]);
        $this->assertEquals("stuff", $response->good);
    }

    public function testPut(): void
    {
        $client = new class extends Client {
            public function put($uri, array $options = []): ResponseInterface
            {
                $expected = [
                    "headers" => ["Authorization" => "Bearer token"],
                    "json" => ["foo" => "bar"],
                ];
                if ($uri == "something/get" && $options == $expected) {
                    return new Response(200, [], '{"good":"stuff"}');
                }
                return new Response(404, [], '{}');
            }
        };
        $masto = new Maphpodon(
            "any",
            "key",
            "secret",
            "token",
            null,
            $client,
        );
        $response = $masto->put("something/get", ["foo" => "bar"]);
        $this->assertEquals("stuff", $response->good);
    }

    public function testUpload(): void
    {
        $client = new class extends Client {
            public function post($uri, array $options = []): ResponseInterface
            {
                $expected = [
                    "headers" => ["Authorization" => "Bearer token"],
                    "foo" => "bar",
                ];
                if ($uri == "something/get" && $options == $expected) {
                    return new Response(200, [], '{"good":"stuff"}');
                }
                return new Response(404, [], '{}');
            }
        };
        $masto = new Maphpodon(
            "any",
            "key",
            "secret",
            "token",
            null,
            $client,
        );
        $response = $masto->upload("something/get", ["foo" => "bar"]);
        $this->assertEquals("stuff", $response->good);
    }

    public function testDelete(): void
    {
        $client = new class extends Client {
            public function delete($uri, array $options = []): ResponseInterface
            {
                $expected = [
                    "headers" => ["Authorization" => "Bearer token"],
                ];
                if ($uri == "something/get" && $options == $expected) {
                    return new Response(200, [], '{"good":"stuff"}');
                }
                return new Response(404, [], '{}');
            }
        };
        $masto = new Maphpodon(
            "any",
            "key",
            "secret",
            "token",
            null,
            $client,
        );
        $response = $masto->delete("something/get");
        $this->assertEquals("stuff", $response->good);
    }
}
