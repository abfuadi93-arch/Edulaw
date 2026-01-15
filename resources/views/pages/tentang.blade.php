@extends('layouts.public')
@section('title','Tentang')
@section('content')
@php
  $aboutImg = \App\Models\SiteSetting::getValue('about_image');
@endphp

<div class="mx-auto max-w-6xl px-4 py-12">
    <div class="grid gap-10 md:grid-cols-2">
        <div>
            <h1 class="text-2xl font-semibold">Tentang Kami</h1>
            <p class="mt-3 text-slate-700">
                Edulaw Project adalah ruang literasi hukum yang memadukan edukasi, riset, dan advokasi kebijakan—dengan fokus pada dampak publik.
            </p>
            <ul class="mt-5 list-disc space-y-2 pl-5 text-slate-700">
                <li>Berpihak pada pembelajaran publik yang mudah diakses</li>
                <li>Riset yang bisa ditelusuri, bukan sekadar opini</li>
                <li>Kolaborasi lintas disiplin</li>
            </ul>
        </div>

        <div class="overflow-hidden rounded-3xl bg-white shadow">
            <img
                class="h-[340px] w-full object-cover"
                src="{{ $aboutImg ? asset('storage/'.$aboutImg) : 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1200&auto=format&fit=crop' }}"
                alt="Tentang Edulaw"
            >
        </div>
    </div>
</div>
@endsection
