@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <!-- Logo y título -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-blue-900">OutFlix</h1>
            <p class="mt-2 text-gray-600">Bienvenido de nuevo</p>
        </div>

        <!-- Formulario de inicio de sesión -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-6">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                <input type="text" name="nombre" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 placeholder-gray-400" placeholder="Ingresa tu nombre">
            </div>
            <div class="mb-6">
                <label for="correo" class="block text-sm font-medium text-gray-700 mb-2">Correo electrónico</label>
                <input type="email" name="correo" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 placeholder-gray-400" placeholder="Ingresa tu correo">
            </div>
            <div class="mb-6" >
                <label for="contraseña" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="contraseña" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 placeholder-gray-400" placeholder="Ingresa tu contraseña">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-300 font-semibold">
                Iniciar Sesión
            </button>
        </form>

        <!-- Enlace de registro -->
        <div class="mt-6 text-center">
            <p class="text-gray-600">¿No tienes una cuenta?</p>
            <button onclick="openModal()" class="text-blue-600 hover:text-blue-500 font-medium transition duration-300">
                Regístrate aquí
            </button>
        </div>
    </div>
</div>

<!-- Modal de Registro -->
<div id="registerModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-6">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full border border-gray-100">
        <h2 class="text-3xl font-bold text-blue-900 mb-6 text-center">Regístrate</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-6">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre completo</label>
                <input type="text" name="nombre" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 placeholder-gray-400" placeholder="Ingresa tu nombre">
            </div>
            <div class="mb-6">
                <label for="correo" class="block text-sm font-medium text-gray-700 mb-2">Correo electrónico</label>
                <input type="email" name="correo" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 placeholder-gray-400" placeholder="Ingresa tu correo">
            </div>
            <div class="mb-6">
                <label for="contraseña" class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                <input type="password" name="contraseña" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 placeholder-gray-400" placeholder="Ingresa tu contraseña">
            </div>
            <div class="mb-6">
                <label for="contraseña_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmar contraseña</label>
                <input type="password" name="contraseña_confirmation" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 placeholder-gray-400" placeholder="Confirma tu contraseña" autocomplete="new-password">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-300 font-semibold">
                Crear cuenta
            </button>
        </form>
        <button onclick="closeModal()" class="mt-4 w-full bg-gray-100 text-gray-700 py-3 rounded-lg hover:bg-gray-200 transition duration-300 font-medium">
            Cancelar
        </button>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('registerModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('registerModal').classList.add('hidden');
    }
</script>
@endsection