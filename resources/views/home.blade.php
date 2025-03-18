@extends('layouts.app')

@section('content')
<div class="container mx-auto text-center p-10">
    <h1 class="text-4xl font-bold text-gray-800">Bienvenido a OutFlix</h1>
    <p class="mt-4 text-gray-600">Explora y gestiona tus películas y series favoritas.</p>
    <a href="{{ route('series.index') }}" class="mt-6 inline-block bg-blue-500 text-white px-6 py-2 rounded-lg">Explorar</a>
</div>
@endsection
