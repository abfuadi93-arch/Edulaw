<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Edulaw Project'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- App assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Trix editor -->
    <link rel="stylesheet" href="https://unpkg.com/trix@2.1.8/dist/trix.css">
    <script defer src="https://unpkg.com/trix@2.1.8/dist/trix.umd.min.js"></script>
<script>
document.addEventListener('trix-file-accept', function (event) {
  event.preventDefault();
});
</script>

    @stack('head')
</head>

<body class="min-h-screen bg-gray-100 font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')

        @hasSection('header')
            <header class="bg-white shadow">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
