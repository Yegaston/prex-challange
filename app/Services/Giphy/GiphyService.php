<?php

namespace App\Services\Giphy;

use App\Models\UserGif;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

/**
 * Class GiphyService.
 */
class GiphyService
{

    public $client;

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
            'query' => []
        ]);
    }

    function search(string $q, int $limit = 20, int $offset = 10)
    {
        $test = $this->makeQuery([
            'q' => $q,
            'limit' => $limit,
            'offset' => $offset
        ]);

        $response = $this->client->get('gifs/search', [
            'query' => $this->makeQuery([
                'q' => $q,
                'limit' => $limit,
                'offset' => $offset
            ])
        ]);

        return json_decode($response->getBody()->getContents());
    }

    function getById(string $id)
    {
        $response = $this->client->get('gifs/' . $id);

        return json_decode($response->getBody()->getContents());
    }

    function saveUserGif(array $data)
    {
        $userGif = UserGif::create([
            'user_id' => auth()->user()->id,
            'gif_id' => $data['gif_id'],
            'alias' => $data['alias'],
        ]);

        return $userGif->load('user');
    }

    public function makeQuery(array $query)
    {
        // TODO Workaround to no use getConfig and improve this code is implement a middleware.
        return array_merge($query, $this->client->getConfig('query'));
    }
}
