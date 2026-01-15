<header class="sticky top-0 z-50 bg-navy-950/95 backdrop-blur text-slate-100">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
        <a href="{{ route('home') }}" class="font-semibold tracking-wide">
            Edulaw <span class="text-slate-300">Project</span>
        </a>

        <nav class="hidden items-center gap-6 text-sm md:flex">
            <a class="hover:text-white {{ request()->routeIs('home') ? 'text-white' : 'text-slate-200' }}"
               href="{{ route('home') }}">Beranda</a>

            <a class="hover:text-white {{ request()->routeIs('program') ? 'text-white' : 'text-slate-200' }}"
               href="{{ route('program') }}">Program</a>

            <a class="hover:text-white {{ request()->routeIs('insight.*') ? 'text-white' : 'text-slate-200' }}"
               href="{{ route('insight.index') }}">Edulaw Insight</a>

            <a class="hover:text-white {{ request()->routeIs('publikasi') ? 'text-white' : 'text-slate-200' }}"
               href="{{ route('publikasi') }}">Riset & Publikasi</a>

            <a class="hover:text-white {{ request()->routeIs('tentang') ? 'text-white' : 'text-slate-200' }}"
               href="{{ route('tentang') }}">Tentang</a>
        </nav>

        <div class="flex items-center gap-2">
            @auth
                @if(auth()->user()->role === 'superadmin')
                    <a href="{{ route('admin.settings.edit') }}"
                       class="hidden rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm hover:bg-white/10 md:inline-block">
                        Admin
                    </a>
                @endif

                <a href="{{ route('opinions.create') }}"
                   class="rounded-xl bg-gold-500 px-3 py-2 text-sm font-semibold text-navy-950 hover:bg-gold-600">
                    Kirim Opini
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm hover:bg-white/10">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm hover:bg-white/10">
                    Login
                </a>

                <a href="{{ route('opinions.create') }}"
                   class="rounded-xl bg-gold-500 px-3 py-2 text-sm font-semibold text-navy-950 hover:bg-gold-600">
                    Kirim Opini
                </a>
            @endauth
        </div>
    </div>
</header>
