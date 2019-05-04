<?php

namespace App\Repositories;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Stream;

class BaseRepository implements RepositoryContract
{
    protected $client;

    public function __construct(string $baseUrl, $accessToken = null)
    {
        if ($accessToken) {
            $this->client = $this->createClient($baseUrl, $accessToken);
        }
    }

    public function get(string $uri, array $query): ?\stdClass
    {
        try {
            $response = $this->client->get($uri, [
                'query' => $query
            ]);
        } catch (ClientException $e) {
            return null;
        }


        $result = json_decode($response->getBody()->getContents());
        if (json_last_error() === JSON_ERROR_NONE) {
            return $result;
        }

        return null;
    }

    public function post(string $uri, array $params): ?\stdClass
    {
        try {
            $response = $this->client->post($uri, [
                'params' => $params,
            ]);
        } catch (ClientException $e) {
            return null;
        }

        $result = json_decode($response->getBody()->getContents());
        if (json_last_error() === JSON_ERROR_NONE) {
            return $result;
        }

        return null;
    }

    public function createClient(string $baseUrl, $accessToken = null): Client
    {
        $config = [
            'base_uri' => $baseUrl,
            'headers' => [
                'Accept' => 'application/json'
            ],
        ];

        if ($accessToken) {
            $config['headers'] = [
                'Authorization' => 'Bearer ' . $accessToken
            ];
        }

        return new Client($config);
    }
}

