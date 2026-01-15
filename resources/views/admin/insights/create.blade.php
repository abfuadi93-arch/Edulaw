@extends('layouts.app')

@section('title', 'Buat Insight')

@section('header')
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Buat Insight</h1>
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
              action="{{ route('admin.insights.store') }}"
              enctype="multipart/form-data">
            @csrf

            <div>
                <label class="text-sm font-semibold text-slate-700">Judul</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
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
                >{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <div class="mt-1 text-sm text-rose-600">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Isi</label>

                <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                <trix-editor input="body" class="mt-2 rounded-lg border border-slate-200 bg-white p-3"></trix-editor>

                @error('body')
                    <div class="mt-1 text-sm text-rose-600">{{ $message }}</div>
                @enderror

                <p class="mt-2 text-xs text-slate-500">
                    Tips: gunakan heading, bold, dan link seperlunya. Hindari paste dari Word tanpa “paste as plain text”.
                </p>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-sm font-semibold text-slate-700">Status</label>
                    <select
                        name="status"
                        class="mt-2 w-full rounded-lg border border-slate-200 p-3 focus:border-navy-400 focus:ring-navy-200"
                    >
                        <option value="draft" @selected(old('status', 'draft') === 'draft')>draft</option>
                        <option value="published" @selected(old('status') === 'published')>published</option>
                    </select>
                    @error('status')
                        <div class="mt-1 text-sm text-rose-600">{{ $message }}</div>
                    @enderror
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
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="submit"
                        class="rounded-lg bg-navy-900 px-4 py-2 text-sm font-semibold text-white hover:bg-navy-950">
                    Simpan
                </button>

                <a href="{{ route('admin.insights.index') }}"
                   class="rounded-lg border border-slate-200 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
