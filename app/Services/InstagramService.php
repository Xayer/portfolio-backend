<?php

namespace App\Services;

use App\Exceptions\MissingAccessTokenExeception;
use App\Repositories\BaseRepository;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class InstagramService extends BaseRepository
{
    const BASE_URL = 'https://api.instagram.com/v1/';
    const USER_RECENT_POSTS_PATH = 'users/self/media/recent';
    public const ACCESS_TOKEN_KEY = 'app.instagram_access_token';
    private static $instance;

    private $accessToken;

    public function __construct()
    {
        $accessToken = config(self::ACCESS_TOKEN_KEY);
        if (!$accessToken) {
            throw new MissingAccessTokenExeception(sprintf('missing %s from env', self::ACCESS_TOKEN_KEY));
        }

        parent::__construct(self::BASE_URL, $accessToken);
    }

    public static function instance()
    {
        if (!self::$instance) {
            self::$instance = new InstagramService();
        }

        return self::$instance;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    public function getRecentPosts($limit = 10, $offset = 0): ?Collection
    {

        try {
            $response = $this->get(self::USER_RECENT_POSTS_PATH, [
                'access_token' => $this->getAccessToken(),
                'count' => $limit
            ]);
        } catch (ClientException $e) {
            return null;
        }
        return collect($response->data);
    }

    public function createClient(string $baseUrl, $accessToken = null): Client
    {
        $config = [
            'base_uri' => $baseUrl,
            'headers' => [
                'Accept' => 'application/json'
            ],
        ];

        $this->setAccessToken($accessToken);

        return new Client($config);
    }
}
