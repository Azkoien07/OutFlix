<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TMDbController extends Controller
{
    public function searchEntertainment(Request $request)
    {
        $query = $request->input('query'); // Obtener el nombre ingresado por el usuario

        $baseUrl = env('TMDB_BASE_URL');
        $apiKey = env('TMDB_API_KEY');

        // Consultar la API para buscar series y películas
        $moviesResponse = Http::withoutVerifying()->get("$baseUrl/search/movie", [
            'api_key' => $apiKey,
            'language' => 'es-ES',
            'query' => $query
        ]);

        $seriesResponse = Http::withoutVerifying()->get("$baseUrl/search/tv", [
            'api_key' => $apiKey,
            'language' => 'es-ES',
            'query' => $query
        ]);

        $movies = $moviesResponse->json()['results'] ?? [];
        $series = $seriesResponse->json()['results'] ?? [];

        return view('entertainment.index', compact('movies', 'series', 'query'));
    }
}
