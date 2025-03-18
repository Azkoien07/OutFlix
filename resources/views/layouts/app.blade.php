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
        </div>
    </nav>

    <div class="container mx-auto mt-8 p-4">
        @yield('content')
    </div>
</body>

</html>