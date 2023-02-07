<?php
namespace Maphpodon;

use Exception;
use GuzzleHttp\Client;
use Maphpodon\entities\Statuses;
use Maphpodon\entities\Timelines;

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

    public function get(string $url, array $params = [])
    {
        try {
            $headers = ($this->authToken !== null) ? ["headers" => ["Bearer " . $this->authToken]] : [];
            $response = $this->client->get($url, array_merge($params, $headers));
            return $this->parseJson($response->getBody()->getContents());
        } catch (Exception $exception) {
            print_r($exception->getMessage());
        }
    }

    public function post(string $url, array $params = [])
    {
        try {
            $headers = [];
            $headers["Authorization"] = "Bearer " . $this->authToken;
            $headers["Idempotency-Key"] =  hash("sha512", $this->authToken . ";" . $url  . ";" . implode(";", $params["json"]));
            $params["headers"] = $headers;
            $response = $this->client->post($url, $params);
            return $this->parseJson($response->getBody()->getContents());
        } catch (Exception $exception) {
            print_r($exception->getMessage());
        }
    }

    private function parseJson(string $contents): mixed
    {
        return \Safe\json_decode($contents);
    }

    public function mapObjectToClass(mixed $item, string $className): mixed
    {
        return $className::build($item);
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