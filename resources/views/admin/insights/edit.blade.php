@extends('layouts.app')

@section('title', 'Edit Insight')

@section('header')
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Edit Insight</h1>
        <a href="{{ route('admin.insights.index') }}"
           class="rounded-lg border px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
            Kembali
        </a>
    </div>
@endsection

@section('content')
    <div class="mx-auto max-w-3xl">
        <form class="space-y-5 rounded-2xl border bg-white p-6 shadow-sm"
              method="POST"
              action="{{ route('admin.insights.update', $insight) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label class="text-sm font-semibold text-slate-700">Judul</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $insight->title) }}"
                    class="mt-2 w-full rounded-lg border border-slate-200 p-3 focus:border-navy-400 focus:ring-navy-200"
                    placeholder="Masukkan judul insight..."
                >
                @error('title')
                    <div class="mt-1 text-sm text-rose-600">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Excerpt</label>
                <textarea
                    name="excerpt"
                    rows="3"
                    class="mt-2 w-full rounded-lg border border-slate-200 p-3 focus:border-navy-400 focus:ring-navy-200"
                    placeholder="Ringkasan singkat (1–3 kalimat)..."
                >{{ old('excerpt', $insight->excerpt) }}</textarea>
                @error('excerpt')
                    <div class="mt-1 text-sm text-rose-600">{{ $message }}</div>
                @enderror
            </div>

            {{-- BLOK ISI (TRIX) — sesuai yang diminta --}}
            <div>
                <label class="text-sm font-semibold">Isi</label>

                <input id="body" type="hidden" name="body" value="{{ old('body', $insight->body) }}">
                <trix-editor input="body" class="mt-2 rounded-lg border bg-white p-3"></trix-editor>

                @error('body')<div class="mt-1 text-sm text-rose-600">{{ $message }}</div>@enderror
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-sm font-semibold text-slate-700">Status</label>
                    <select
                        name="status"
                        class="mt-2 w-full rounded-lg border border-slate-200 p-3 focus:border-navy-400 focus:ring-navy-200"
                    >
                        <option value="draft" @selected(old('status', $insight->status) === 'draft')>draft</option>
                        <option value="published" @selected(old('status', $insight->status) === 'published')>published</option>
                    </select>
                    @error('status')
                        <div class="mt-1 text-sm text-rose-600">{{ $message }}</div>
                    @enderror

                    <div class="mt-2 text-xs text-slate-500">
                        Published at: {{ $insight->published_at ? $insight->published_at->format('Y-m-d H:i') : '-' }}
                    </div>
                </div>

                <div>
                    <label class="text-sm font-semibold text-slate-700">Cover (opsional)</label>
                    <input
                        type="file"
                        name="cover_image"
                        accept="image/*"
                        class="mt-2 w-full rounded-lg border border-slate-200 p-3"
                    >
                    @error('cover_image')
                        <div class="mt-1 text-sm text-rose-600">{{ $message }}</div>
                    @enderror

                    @if($insight->cover_image)
                        <div class="mt-3">
                            <div class="text-xs font-semibold text-slate-600">Cover saat ini</div>
                            <img
                                class="mt-2 h-28 w-full rounded-xl object-cover"
                                src="{{ asset('storage/'.$insight->cover_image) }}"
                                alt="Cover Insight"
                            >
                        </div>
                    @endif
                </div>
            </div>

<div class="flex flex-wrap gap-3">
    <button class="rounded-lg bg-navy-900 px-4 py-2 text-sm font-semibold text-white">Update</button>

    <a target="_blank"
       href="{{ route('admin.insights.preview', $insight) }}"
       class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
        Preview
    </a>

    <a href="{{ route('admin.insights.index') }}" class="rounded-lg border px-4 py-2 text-sm">Kembali</a>
</div>
            </div>
        </form>
    </div>
@endsection
