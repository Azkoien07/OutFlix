@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Buscar Películas</h1>

    <!-- Formulario de búsqueda -->
    <form action="{{ route('search') }}" method="GET" class="mb-6 flex gap-2">
        <input type="text" name="query" value="{{ $searchTerm ?? '' }}" 
               placeholder="Buscar películas..."
               class="border p-2 w-full rounded-lg focus:ring focus:ring-blue-300">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Buscar
        </button>
    </form>

    @isset($error)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ $error }}
        </div>
    @endisset

    @if(($searchPerformed ?? false) && count($results ?? []) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($results as $movie)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Imagen del poster -->
                    <div class="relative pb-[150%]">
                        <img src="{{ $movie['poster_path'] }}" 
                             alt="{{ $movie['title'] }}"
                             class="absolute w-full h-full object-cover"
                             loading="lazy">
                    </div>
                    
                    <!-- Contenido -->
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-1 truncate">{{ $movie['title'] }}</h3>
                        
                        @isset($movie['release_date'])
                            <p class="text-gray-500 text-sm mb-2">
                                {{ \Carbon\Carbon::parse($movie['release_date'])->format('Y') }}
                            </p>
                        @endisset
                        
                        <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                            {{ $movie['overview'] }}
                        </p>
                        
                        <div class="flex items-center">
                            <span class="text-yellow-500 mr-1">★</span>
                            <span>{{ number_format($movie['vote_average'], 1) }}/10</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif($searchPerformed ?? false)
        <p class="text-center text-gray-500">No se encontraron resultados para "{{ $searchTerm }}"</p>
    @endif
</div>
@endsection