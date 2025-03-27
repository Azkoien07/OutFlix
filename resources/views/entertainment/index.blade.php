@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Buscar Películas y Series</h1>

    <!-- 🔍 Formulario de búsqueda -->
    <form action="{{ route('search.movie') }}" method="GET" class="mb-6 flex gap-2">
        <input type="text" name="query" placeholder="Buscar película o serie..."
               class="border p-2 w-full rounded-lg focus:ring focus:ring-blue-300">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Buscar</button>
    </form>

    @if(isset($movies) && count($movies) > 0)
        <!-- 🎬 Mostrar resultados -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($movies as $movie)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] : asset('images/default-movie.jpg') }}" 
                         alt="{{ $movie['title'] ?? 'Título no disponible' }}"
                         class="w-full h-80 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-bold">{{ $movie['title'] ?? 'Título no disponible' }}</h2>
                        <p class="text-gray-600">{{ $movie['overview'] ?? 'Sin descripción.' }}</p>

                        <!-- ⭐ Formulario de valoración -->
                        <form action="{{ route('rate.movie') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">

                            <label for="rating_{{ $movie['id'] }}" class="block text-gray-700">Tu valoración:</label>
                            <select name="rating" id="rating_{{ $movie['id'] }}" class="border p-2 rounded-lg w-full">
                                <option value="1">⭐ 1 - Muy Mala</option>
                                <option value="2">⭐⭐ 2 - Mala</option>
                                <option value="3">⭐⭐⭐ 3 - Regular</option>
                                <option value="4">⭐⭐⭐⭐ 4 - Buena</option>
                                <option value="5">⭐⭐⭐⭐⭐ 5 - Excelente</option>
                            </select>

                            <label for="category_{{ $movie['id'] }}" class="block text-gray-700 mt-2">Categoría:</label>
                            <select name="category" id="category_{{ $movie['id'] }}" class="border p-2 rounded-lg w-full">
                                <option value="accion">Acción</option>
                                <option value="aventura">Aventura</option>
                                <option value="comedia">Comedia</option>
                                <option value="drama">Drama</option>
                                <option value="terror">Terror</option>
                                <option value="ciencia_ficcion">Ciencia Ficción</option>
                                <option value="fantasia">Fantasía</option>
                                <option value="documental">Documental</option>
                            </select>

                            <label for="status_{{ $movie['id'] }}" class="block text-gray-700 mt-2">Estado de visualización:</label>
                            <select name="status" id="status_{{ $movie['id'] }}" class="border p-2 rounded-lg w-full">
                                <option value="pendiente">📌 Pendiente</option>
                                <option value="viendo">▶️ Viendo</option>
                                <option value="terminado">✅ Terminado</option>
                            </select>

                            <label for="comment_{{ $movie['id'] }}" class="block text-gray-700 mt-2">Comentario:</label>
                            <textarea name="comment" id="comment_{{ $movie['id'] }}" rows="3" class="border p-2 rounded-lg w-full"></textarea>

                            <button type="submit" class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                                Enviar valoración
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif(request()->has('query'))
        <p class="text-red-600 text-center">No se encontraron resultados para "{{ request('query') }}".</p>
    @endif
</div>
@endsection
