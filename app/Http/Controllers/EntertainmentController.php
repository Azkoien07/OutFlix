<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

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

    public function save(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required',
            'movie_title' => 'required',
            'categoria' => 'required|string|max:255',
            'estado_visto' => 'required|string|max:255',
            'comentario' => 'nullable|string'
        ]);


        $categoria = DB::table('categorias')->where('nombre', $validated['categoria'])->first();

        if (!$categoria) {
            DB::table('categorias')->insert([
                'nombre' => $validated['categoria'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $estado = DB::table('estado_visto')->where('estado', $validated['estado_visto'])->first();

        if (!$estado) {
            DB::table('estado_visto')->insert([
                'estado' => $validated['estado_visto'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return redirect()->back()->with('success', 'Información guardada correctamente');
    }
}
