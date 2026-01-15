@extends('layouts.public')
@section('title','Edulaw Insight')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-12">
    <div class="flex items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold">Edulaw Insight</h1>
            <p class="mt-2 text-slate-600">Tulisan terpilih yang sudah melalui proses moderasi.</p>
        </div>
        <a href="{{ route('kirim-opini') }}" class="rounded-lg bg-yellow-400 px-4 py-2 text-sm font-semibold text-blue-950 hover:bg-yellow-300">
            Kirim Opini
        </a>
    </div>

    <div class="mt-8 grid gap-4 md:grid-cols-3">
        @forelse($opinions as $opinion)
            <a href="{{ route('insight.show', $opinion->slug) }}" class="block rounded-2xl bg-white p-6 shadow hover:shadow-md">
                <div class="text-xs text-slate-500">
                    {{ $opinion->published_at?->format('d M Y') }}
                </div>
                <div class="mt-2 font-semibold">{{ $opinion->title }}</div>
                <div class="mt-3 text-sm text-slate-600 line-clamp-3">
                    {{ \Illuminate\Support\Str::limit(strip_tags($opinion->content), 160) }}
                </div>
            </a>
        @empty
            <div class="rounded-2xl bg-white p-6 shadow md:col-span-3">
                Belum ada insight yang dipublikasikan.
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $opinions->links() }}
    </div>
</div>
@endsection
