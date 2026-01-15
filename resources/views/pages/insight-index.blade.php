@extends('layouts.public')
@section('title','Edulaw Insight')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-14">
    <div class="flex items-end justify-between gap-6">
        <div>
            <h1 class="text-2xl font-semibold">Edulaw Insight</h1>
            <p class="mt-2 text-sm text-slate-600">Tulisan terbaru—analisis singkat, relevan, dan mudah dibaca.</p>
        </div>
    </div>

    <div class="mt-8 grid gap-4 md:grid-cols-3">
        @foreach($insights as $item)
            <a href="{{ route('insight.show', $item->slug) }}" class="group rounded-2xl border bg-white p-5 shadow-sm hover:shadow">
                <div class="aspect-[16/10] overflow-hidden rounded-xl bg-slate-100">
                    @if($item->cover_image)
                        <img class="h-full w-full object-cover group-hover:scale-[1.01] transition"
                             src="{{ asset('storage/'.$item->cover_image) }}" alt="{{ $item->title }}">
                    @endif
                </div>
                <div class="mt-4 font-semibold leading-snug">{{ $item->title }}</div>
                <div class="mt-2 text-sm text-slate-600">{{ $item->excerpt }}</div>
                <div class="mt-4 text-sm font-semibold text-navy-900">Baca →</div>
            </a>
        @endforeach
    </div>

    <div class="mt-10">
        {{ $insights->links() }}
    </div>
</section>
@endsection
