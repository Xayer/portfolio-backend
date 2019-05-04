<?php

namespace App\Repositories;

use GuzzleHttp\Client;

interface RepositoryContract
{
    public function createClient(string $baseUrl, $accessToken = null): Client;

    public function get(string $uri, array $query): ?\stdClass;

    public function post(string $uri, array $params): ?\stdClass;
}
