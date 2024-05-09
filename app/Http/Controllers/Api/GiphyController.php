<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Giphy\GiphySearchRequest;
use App\Services\Giphy\GiphyService;
use Illuminate\Http\Request;

class GiphyController extends Controller
{
    protected $giphyService;

    public function __construct(GiphyService $giphyService)
    {
        $this->giphyService = $giphyService;
    }

    public function search(GiphySearchRequest $request)
    {
        $response = $this->giphyService->search(
            $request['query'],
            $request->query('limit', 10),
            $request->query('offset', 20)
        );

        return $this->response($response ?? [], $response ? 200 : 204);
    }

    public function getById(string $id)
    {
        return $this->response($this->giphyService->getById($id));
    }

    public function userGif(string $id)
    {
        return $this->response($this->giphyService->saveUserGif($id));
    }
}
