@extends('layouts.public')
@section('title','Program')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-14">
  <h1 class="text-2xl font-semibold">Program</h1>

  @if($programs->isEmpty())
    <div class="mt-6 rounded-2xl border bg-white p-6 text-slate-600">
      Belum ada program yang ditampilkan.
    </div>
  @else
    <div class="mt-6 grid gap-4 md:grid-cols-2">
      @foreach($programs as $p)
        <div class="rounded-2xl border bg-white p-6 shadow-sm">
          <div class="font-semibold">{{ $p->title }}</div>
          <p class="mt-2 text-sm text-slate-600">{{ $p->excerpt }}</p>
        </div>
      @endforeach
    </div>
  @endif
</section>
@endsection
