@extends('layouts.public')
@section('title', 'Kirim Opini')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-12">
    <h1 class="text-2xl font-semibold">Kirim Opini</h1>
    <p class="mt-2 text-slate-600">
        Opini akan ditinjau terlebih dahulu sebelum dipublikasikan di Edulaw Insight.
    </p>

    @if (session('status'))
        <div class="mt-6 rounded-xl bg-green-50 p-4 text-green-800">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('opinions.store') }}" class="mt-6 space-y-5 rounded-2xl bg-white p-6 shadow">
        @csrf

        <div>
            <label class="block text-sm font-medium">Judul</label>
            <input
                name="title"
                value="{{ old('title') }}"
                class="mt-1 w-full rounded-lg border-slate-300"
            />
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Isi Opini</label>
            <textarea
                name="content"
                rows="10"
                class="mt-1 w-full rounded-lg border-slate-300"
            >{{ old('content') }}</textarea>

            @error('content')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <p class="mt-2 text-xs text-slate-500">Minimal 50 karakter.</p>
        </div>

        <p class="text-slate-600">
            Kamu login sebagai <span class="font-medium">{{ auth()->user()->name }}</span>.
        </p>

        <div class="flex items-center gap-3">
            <button type="submit" class="rounded-lg bg-blue-950 px-4 py-2 font-semibold text-white hover:bg-blue-900">
                Kirim
            </button>

            <a href="{{ route('home') }}" class="rounded-lg border px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                Batal
            </a>
        </div>
    </form>

    {{-- Revisi yang diminta (referensi) --}}
    {{-- action="{{ route('kirim-opini.store') }}" --}}
    {{-- action="{{ route('opinions.store') }}" --}}
</div>
@endsection
