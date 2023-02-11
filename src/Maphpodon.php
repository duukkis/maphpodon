<?php

namespace Maphpodon;

use Exception;
use GuzzleHttp\Client;
use Maphpodon\entities\Accounts;
use Maphpodon\entities\Apps;
use Maphpodon\entities\Auth;
use Maphpodon\entities\Instance;
use Maphpodon\entities\Media;
use Maphpodon\entities\Notifications;
use Maphpodon\entities\Search;
use Maphpodon\entities\Statuses;
use Maphpodon\entities\Timelines;
use Maphpodon\helpers\ExceptionCatcher;
use Maphpodon\helpers\MaphpodonExceptionCatcher;

class Maphpodon
{
    protected Client $client;
    protected ExceptionCatcher $exceptionCatcher;

    public function __construct(
        protected string $domain,
        public ?string $clientKey = null,
        public ?string $clientSecret = null,
        public ?string $authToken = null,
        ExceptionCatcher $exceptionCatcher = null,
        ?Client $client = null,
    ) {
        $this->client = $client ?? new Client(
            [
                'base_uri' => 'https://' . $domain . '/api/',
                'timeout' => 10,
            ]
        );
        $this->exceptionCatcher = $exceptionCatcher ?? new MaphpodonExceptionCatcher();
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function get(string $url, array $params = []): mixed
    {
        try {
            $headers = [];
            if ($this->authToken !== null) {
                $headers["Authorization"] = "Bearer " . $this->authToken;
            }
            $response = $this->client->get(
                $url,
                [
                    "query" => $params,
                    "headers" => $headers
                ]
            );
            return $this->parseJson($response->getBody()->getContents());
        } catch (Exception $exception) {
            $this->exceptionCatcher->handleException($exception);
        }
    }

    public function post(string $url, array $params = []): mixed
    {
        try {
            $headers = [];
            if ($this->authToken !== null) {
                $headers["Authorization"] = "Bearer " . $this->authToken;
            }
            // forget this for now
            // $headers["Idempotency-Key"] =  hash("sha512", $this->authToken . ";" . $url  . ";" . );
            $response = $this->client->post($url,
                [
                    "json" => $params,
                    "headers" => $headers
                ]);
            return $this->parseJson($response->getBody()->getContents());
        } catch (Exception $exception) {
            $this->exceptionCatcher->handleException($exception);
        }
    }

    public function upload(string $url, array $params = []): mixed
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
            $this->exceptionCatcher->handleException($exception);
        }
    }

    public function delete(string $url, array $params = []): mixed
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
            $this->exceptionCatcher->handleException($exception);
        }
    }

    private function parseJson(string $contents): mixed
    {
        return \Safe\json_decode($contents);
    }

    public function auth(): Auth
    {
        // we could fix the client baseUrl here also?
        return new Auth($this);
    }

    public function accounts(): Accounts
    {
        return new Accounts($this);
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

    public function instance(): Instance
    {
        return new Instance($this);
    }

    public function search(): Search
    {
        return new Search($this);
    }

    public function notifications(): Notifications
    {
        return new Notifications($this);
    }

    public function apps(): Apps
    {
        return new Apps($this);
    }
}
