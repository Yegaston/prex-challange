<?php

use App\Models\User;
use App\Models\UserGif;
use App\Services\Giphy\GiphyService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Config;

it('can search gifs', function () {
    // Mocking Guzzle client response
    $mockResponse = new Response(
        200,
        [],
        json_encode(['data' => ['gif1', 'gif2']]) // Assuming this is how the response would look
    );
    $mockClient = Mockery::mock(Client::class);
    $mockClient->shouldReceive('get')
        ->with('gifs/search', [
            'query' => [
                'api_key' => Config::get('giphy.api_key'),
            ]
        ])
        ->andReturn($mockResponse);

    $service = new GiphyService();
    $service->client = $mockClient;

    $result = $service->search('cats', 10, 20);

    expect($result->data)->toBe(['gif1', 'gif2']);
});

it('can get gif by id', function () {
    // Mocking Guzzle client response
    $mockResponse = new Response(
        200,
        [],
        json_encode(['data' => 'gif-details']) // Assuming this is how the response would look
    );
    $mockClient = Mockery::mock(Client::class);
    $mockClient->shouldReceive('get')
        ->with('gifs/gif-id')
        ->andReturn($mockResponse);

    $service = new GiphyService();
    $service->client = $mockClient;

    $result = $service->getById('gif-id');

    expect($result->data)->toBe('gif-details');
});


