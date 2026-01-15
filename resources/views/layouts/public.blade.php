<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#07162E">

    <title>@yield('title', 'Edulaw Project')</title>

    @stack('head')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- untuk script tambahan yang memang harus di <head> --}}
    @stack('head-scripts')
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased flex flex-col">
    @include('partials.public-nav')

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="bg-navy-950 text-slate-200">
        <div class="border-t border-white/10">
            <div class="mx-auto max-w-6xl px-4 py-10">
                <div class="grid grid-cols-1 gap-10 md:grid-cols-4">
                    <div>
                        <div class="font-semibold">Edulaw Project</div>
                        <p class="mt-2 text-sm text-slate-300">
                            Literasi hukum, riset, dan kolaborasi kebijakan.
                        </p>
                    </div>

                    <div>
                        <div class="font-semibold">Program</div>
                        <div class="mt-3 space-y-2 text-sm text-slate-300">
                            <a class="block hover:text-white" href="{{ route('program') }}">Kelas & Webinar</a>
                            <a class="block hover:text-white" href="{{ route('program') }}">Konten Digital</a>
                            <a class="block hover:text-white" href="{{ route('program') }}">Riset & Policy Brief</a>
                            <a class="block hover:text-white" href="{{ route('program') }}">Kolaborasi</a>
                        </div>
                    </div>

                    <div>
                        <div class="font-semibold">Sumber Daya</div>
                        <div class="mt-3 space-y-2 text-sm text-slate-300">
                            <a class="block hover:text-white" href="{{ route('insight.index') }}">Edulaw Insight</a>
                            <a class="block hover:text-white" href="{{ route('publikasi') }}">Riset & Publikasi</a>
                        </div>
                    </div>

                    <div>
                        <div class="font-semibold">Perusahaan</div>
                        <div class="mt-3 space-y-2 text-sm text-slate-300">
                            <a class="block hover:text-white" href="{{ route('tentang') }}">Tentang</a>

                            @auth
                                <a class="block hover:text-white" href="{{ route('opinions.create') }}">Kirim Opini</a>
                            @else
                                <a class="block hover:text-white" href="{{ route('login') }}">Kirim Opini</a>
                            @endauth
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex flex-col gap-3 border-t border-white/10 pt-6 text-sm text-slate-300 md:flex-row md:items-center md:justify-between">
                    <div>© {{ date('Y') }} Edulaw Project</div>

                    <div class="flex gap-4">
                        <a class="hover:text-white" href="#">Privacy</a>
                        <a class="hover:text-white" href="#">Terms</a>
                        <a class="hover:text-white" href="#">Disclaimer</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- script tambahan idealnya ditaruh sebelum </body> --}}
    @stack('scripts')
</body>
</html>
