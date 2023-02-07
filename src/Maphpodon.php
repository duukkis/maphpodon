<?php
namespace Maphpodon;

use Exception;
use GuzzleHttp\Client;
use Maphpodon\entities\Media;
use Maphpodon\entities\Statuses;
use Maphpodon\entities\Timelines;
use Maphpodon\instances\Model;

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
            'base_uri'=> 'https://' . $domain . '/api/',
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

    public function media(): Media
    {
        return new Media($this);
    }

    public function get(string $url, array $params = [])
    {
        try {
            $headers = [];
            if ($this->authToken !== null) {
                $headers["Authorization"] = "Bearer " . $this->authToken;
            }
            $params["headers"] = $headers;
            $response = $this->client->get($url, $params);
            return $this->parseJson($response->getBody()->getContents());
        } catch (Exception $exception) {
            print_r($exception->getMessage());
            die();
        }
    }

    public function post(string $url, array $params = [])
    {
        try {
            $headers = [];
            if ($this->authToken !== null) {
                $headers["Authorization"] = "Bearer " . $this->authToken;
            }
            $headers["Idempotency-Key"] =  hash("sha512", $this->authToken . ";" . $url  . ";" . implode(";", $params["json"]));
            $params["headers"] = $headers;
            $response = $this->client->post($url, $params);
            return $this->parseJson($response->getBody()->getContents());
        } catch (Exception $exception) {
            print_r($exception->getMessage());
            die();
        }
    }

    public function upload(string $url, array $params = [])
    {
        try {
            $headers = [];
            if ($this->authToken !== null) {
                $headers["Authorization"] = "Bearer " . $this->authToken;
            }
            $params["headers"] = $headers;
            $response = $this->client->post($url, $params);
            $x = $this->parseJson($response->getBody()->getContents());
            return $x;
        } catch (Exception $exception) {
            print_r($exception->getMessage());
            die();
        }
    }

    public function delete(string $url, array $params = [])
    {
        try {
            $headers = [];
            if ($this->authToken !== null) {
                $headers["Authorization"] = "Bearer " . $this->authToken;
            }
            $params["headers"] = $headers;
            $response = $this->client->delete($url, $params);
            return $this->parseJson($response->getBody()->getContents());
        } catch (Exception $exception) {
            print_r($exception->getMessage());
            die();
        }
    }

    private function parseJson(string $contents): mixed
    {
        return \Safe\json_decode($contents);
    }

    public function mapObjectToClass(mixed $item, Model $model): mixed
    {
        return $model::build($item, $model);
    }

    public function mapObjectToClassArray(array $items, Model $model): array
    {
        $result = [];
        foreach ($items as $i => $item) {
            $entity = $model::build($item, $model);
            array_push($result, $entity);
        }
        return $result;
    }
}