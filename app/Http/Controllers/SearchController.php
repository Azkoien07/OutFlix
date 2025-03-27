<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.tmdb.api_key');
        $this->baseUrl = 'https://api.themoviedb.org/3';
        if (empty($this->apiKey)) {
            Log::error('TMDB API Key no está configurada');
        }
    }

    public function search(Request $request)
    {
        $query = trim($request->input('query', ''));

        $viewData = [
            'results' => [],
            'searchTerm' => $query,
            'error' => null,
            'searchPerformed' => !empty($query) // Siempre definida
        ];

        if (!$viewData['searchPerformed']) {
            return view('entertainment.index', $viewData);
        }

        try {
            $response = Http::withoutVerifying()->get("{$this->baseUrl}/search/movie", [
                'api_key' => $this->apiKey,
                'query' => $query,
                'language' => 'es-ES',
                'include_adult' => false
            ]);

            if ($response->successful()) {
                $apiResults = $response->json();

                $viewData['results'] = array_map(function ($item) {
                    return [
                        'id' => $item['id'],
                        'title' => $item['title'] ?? $item['original_title'] ?? 'Sin título',
                        'overview' => $item['overview'] ?? 'Descripción no disponible',
                        'poster_path' => $item['poster_path']
                            ? 'https://image.tmdb.org/t/p/w500' . $item['poster_path']
                            : asset('images/default-movie.jpg'),
                        'release_date' => $item['release_date'] ?? null,
                        'vote_average' => $item['vote_average'] ?? 0,
                        'media_type' => 'movie'
                    ];
                }, $apiResults['results'] ?? []);

                if (empty($viewData['results'])) {
                    $viewData['error'] = "No se encontraron resultados para \"{$query}\"";
                }
            } else {
                $viewData['error'] = "Error en la API: " . $response->status();
            }
        } catch (\Exception $e) {
            $viewData['error'] = 'Error al realizar la búsqueda: ' . $e->getMessage();
        }

        return view('entertainment.index', $viewData);
    }
}
