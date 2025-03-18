<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class RatingController extends Controller
{
    public function store(Request $request)
    {
        // Obtener los datos enviados desde el formulario
        $movieId = $request->input('movie_id');
        $rating = $request->input('rating');
        $comment = $request->input('comment');

        // Aquí podrías guardar la valoración en la base de datos
        // Por ahora, solo retornamos los datos
        return back()->with('success', '¡Valoración enviada con éxito!');
    }
}