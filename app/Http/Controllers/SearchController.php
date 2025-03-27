<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = trim($request->input('query'));

        if (empty($query)) {
            return view('entertainment.index', [
                'movies' => [],
                'tvShows' => [],
                'error' => null,
                'searchPerformed' => false
            ]);
        }

        try {
            $apiKey = config('services.tmdb.api_key');
            $response = Http::get("https://api.themoviedb.org/3/search/multi", [
                'api_key' => $apiKey,
                'query' => $query,
                'language' => 'es-ES',
                'include_adult' => false
            ]);

            $results = $response->json()['results'] ?? [];

            return view('entertainment.index', [
                'movies' => $results,
                'searchTerm' => $query,
                'error' => empty($results) ? "No se encontraron resultados para \"{$query}\"." : null,
                'searchPerformed' => true
            ]);
        } catch (\Exception $e) {
            return view('entertainment.index', [
                'movies' => [],
                'searchTerm' => $query,
                'error' => 'Error al realizar la búsqueda: ' . $e->getMessage(),
                'searchPerformed' => true
            ]);
        }
    }
}
