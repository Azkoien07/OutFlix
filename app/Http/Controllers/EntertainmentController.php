<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EntertainmentController extends Controller
{
    public function index()
    {
        $apiKey = env('TMDB_API_KEY');

        // Obtener películas populares
        $moviesResponse = Http::withoutVerifying()->get("https://api.themoviedb.org/3/movie/popular?api_key=$apiKey&language=es-ES");
        $movies = $moviesResponse->successful() ? $moviesResponse->json()['results'] : [];

        // Obtener series populares
        $seriesResponse = Http::withoutVerifying()->get("https://api.themoviedb.org/3/movie/popular?api_key=$apiKey&language=es-ES");
        $series = $seriesResponse->successful() ? $seriesResponse->json()['results'] : [];

        return view('entertainment.index', compact('movies', 'series'));
    }
}
