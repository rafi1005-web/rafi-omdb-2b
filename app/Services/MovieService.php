<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MovieService
{
    private $apiKey;
    private $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('omdb.api_key');
        $this->baseUrl = config('omdb.base_url');
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
