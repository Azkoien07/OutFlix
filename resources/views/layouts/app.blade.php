<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'OutFlix')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-gradient-nav {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        }

        .hover\:bg-gradient-nav:hover {
            background: linear-gradient(135deg, #3b82f6, #1e3a8a);
        }
    </style>
</head>

<body class="bg-gray-50">
    <nav class="bg-gradient-nav shadow-lg">
        <div class="container mx-auto flex justify-between items-center p-4">
            <a href="{{ route('home') }}" class="font-bold text-2xl text-white hover:text-gray-200 transition duration-300">OutFlix</a>
            
            @auth
                @if(!request()->is('login'))
                <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Cerrar Sesión
                    </button>
                </form>
                @endif
            @endauth
        </div>
    </nav>

    <div class="container mx-auto mt-8 p-4">
        @yield('content')
    </div>
</body>

</html>