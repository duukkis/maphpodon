<?php
namespace Maphpodon;

use Exception;
use GuzzleHttp\Client;
use Maphpodon\entities\Statuses;
use Maphpodon\entities\Timelines;
use Maphpodon\instances\Status;
use ReflectionClass;

class Maphpodon
{
    protected Client $client;

    public function __construct(
        protected string $domain,
        public ?string $clientKey = null,
        public ?string $clientSecret = null,
        public ?string $authToken = null,
        ?Client $client = null
    )
    {
        $this->client = $client ?? new Client([
            'base_uri'=> 'https://' . $domain . '/api/v1/',
            'timeout' => 10,
        ]);
    }

    public function statuses(): Statuses
    {
        return new Statuses($this);
    }

    public function timelines(): Timelines
    {
        return new Timelines($this);
    }

    public function get(string $url)
    {
        try {
            $headers = ($this->authToken !== null) ? ["headers" => ["Bearer " . $this->authToken]] : [];
            $response = $this->client->get($url, $headers);
            return $this->parseJson($response->getBody()->getContents());
        } catch (Exception $exception) {
            print_r($exception->getMessage());
        }
    }

    private function parseJson(string $contents): mixed
    {
        return \Safe\json_decode($contents);
    }

    public function mapObjectToClassArray(array $items, string $className): array
    {
        $result = [];
        foreach ($items as $i => $item) {
            $entity = $className::build($item);
            array_push($result, $entity);
        }
        return $result;
    }
}