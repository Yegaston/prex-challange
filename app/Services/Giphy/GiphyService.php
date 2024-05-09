<?php

namespace App\Services\Giphy;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

/**
 * Class GiphyService.
 */
class GiphyService
{

    protected $client;

    public function __construct()
    {
        // Configure guzzle to use giphy
        $giphyBaseUrl = 'api.giphy.com/v1/';

        $this->client = new Client([
            'base_uri' => $giphyBaseUrl,
            'timeout' => 2.0,
            'headers' => [
                'Accept' => 'application/json',
            ],
            'query' => [
                'api_key' => Config::get('giphy.api_key'),
            ]
        ]);
    }

    function search(string $q, int $limit = 20, int $offset = 10)
    {
        $response = $this->client->get('gifs/search', [
            'query' => $this->makeQuery([
                'q' => $q,
                'limit' => $limit,
                'offset' => $offset
            ])
        ]);

        return json_decode($response->getBody()->getContents());
    }

    private function makeQuery(array $query)
    {
        // Workaround to no use getConfig is implement a middleware.
        return array_merge($query, $this->client->getConfig('query'));
    }
}
