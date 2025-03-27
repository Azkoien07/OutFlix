<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TMDBServices
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.tmdb.api_key');
        $this->baseUrl = 'https://api.themoviedb.org/3';
    }

    public function searchMovies(string $query, array $params = [])
    {
        $response = Http::get("{$this->baseUrl}/search/movie", [
            'api_key' => $this->apiKey,
            'query' => $query,
            'language' => 'es-ES',
            'page' => $params['page'] ?? 1
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        Log::error('TMDB API Error', [
            'status' => $response->status(),
            'response' => $response->body()
        ]);

        throw new \Exception("Error al buscar películas: " . $response->status());
    }
}