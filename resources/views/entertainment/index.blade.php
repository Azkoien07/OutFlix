@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6" x-data="{ activeCardId: null }">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Buscar Películas</h1>
    </div>

    <!-- Formulario de búsqueda -->
    <form action="{{ route('search') }}" method="GET" class="mb-6 flex items-center gap-4 w-full max-w-5xl mx-auto">
        <input type="text" name="query" value="{{ $searchTerm ?? '' }}"
            placeholder="Buscar películas..."
            class="flex-grow border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-300 text-lg">
        <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 text-lg">
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
        @php
            $categories = ['Acción', 'Aventura', 'Drama', 'Comedia', 'Terror', 'Ciencia Ficción'];
            $statuses = ['Pendiente', 'Viendo', 'Vista'];
        @endphp

        @foreach($results as $movie)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow cursor-pointer border"
            @click="activeCardId = activeCardId === {{ $movie['id'] }} ? null : {{ $movie['id'] }}">
            
            <div class="relative w-full h-80">
                <img src="{{ $movie['poster_path'] }}" 
                     alt="{{ $movie['title'] }}"
                     class="absolute w-full h-full object-cover"
                     loading="lazy">
            </div>

            <div class="p-4">
                <h3 class="font-bold text-lg mb-1 truncate text-gray-800">{{ $movie['title'] }}</h3>
                <p class="text-gray-500 text-sm mb-2">
                    {{ \Carbon\Carbon::parse($movie['release_date'])->format('Y') }}
                </p>
                <div class="flex items-center text-yellow-500">
                    <span class="mr-1">★</span>
                    <span class="text-gray-700">{{ number_format($movie['vote_average'], 1) }}/10</span>
                </div>
            </div>

            <!-- Contenido Expandido -->
            <div 
                x-show="activeCardId === {{ $movie['id'] }}" 
                x-collapse 
                class="p-4 border-t bg-gray-50">
                <h4 class="font-semibold mb-2 text-gray-800">Clasificación por categorías:</h4>
                <select class="w-full border border-gray-300 rounded p-2 bg-white" @click.stop>
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>

                <h4 class="font-semibold mt-4 mb-2 text-gray-800">Estado de visualización:</h4>
                <select class="w-full border border-gray-300 rounded p-2 bg-white" @click.stop>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}">{{ $status }}</option>
                    @endforeach
                </select>

                <h4 class="font-semibold mt-4 mb-2 text-gray-800">Valoraciones y comentarios:</h4>
                <textarea class="w-full border border-gray-300 rounded p-2 bg-white" placeholder="Escribe tu opinión..." @click.stop></textarea>

                <button class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 mt-2 transition" @click.stop>
                    Guardar Valoración
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @elseif($searchPerformed ?? false)
    <p class="text-center text-gray-500">No se encontraron resultados para "{{ $searchTerm }}"</p>
    @endif
</div>

@push('styles')
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
@endpush
@endsection