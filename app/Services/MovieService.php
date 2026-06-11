<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MovieService
{
    private $apiKey;
    private $baseUrl;

    public function __construct()
    {
        $this->apiKey = '145ec45b';
        $this->baseUrl = 'http://www.omdbapi.com/';
    }

    public function searchMovies($keyword)
    {
        $response = Http::get($this->baseUrl, [
            'apikey' => $this->apiKey,
            's' => $keyword
        ]);

        return $response->successful() ? ($response->json()['Search'] ?? []) : [];
    }

    public function getMovieDetail($id)
    {
        $response = Http::get($this->baseUrl, [
            'i' => $id,
            'apikey' => $this->apiKey
        ]);

        return $response->json();
    }
}
