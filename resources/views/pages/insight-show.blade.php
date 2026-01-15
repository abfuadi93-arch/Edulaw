@extends('layouts.public')
@section('title', $insight->title)

@section('content')
<section class="mx-auto max-w-3xl px-4 py-10 md:py-12">
  <a href="{{ route('insight.index') }}" class="text-sm text-slate-600 hover:text-slate-900">
    ← Kembali
  </a>

  <h1 class="mt-4 text-3xl font-semibold leading-tight text-slate-900">
    {{ $insight->title }}
  </h1>

  <div class="mt-2 text-sm text-slate-500">
    {{ $insight->published_at?->format('d M Y') ?? $insight->created_at?->format('d M Y') }}
  </div>

  @if($insight->cover_image)
    <div class="mt-6 overflow-hidden rounded-3xl border border-slate-200 bg-slate-100">
      <img
        class="h-[260px] w-full object-cover md:h-[360px]"
        src="{{ asset('storage/'.$insight->cover_image) }}"
        alt="{{ $insight->title }}"
        loading="lazy"
      >
    </div>
  @endif

  <article class="prose prose-slate mt-8 max-w-none">
    {!! $insight->body !!}
  </article>
</section>
@endsection
