@extends('layouts.public')
@section('title','Beranda')

@section('content')
@php
  $hero = \App\Models\SiteSetting::getValue('hero_image');
@endphp

{{-- 1) HERO --}}
<section class="bg-navy-950 text-slate-100">
  <div class="mx-auto max-w-7xl px-4">
    <div class="grid min-h-[78vh] items-center gap-10 py-10 md:min-h-[88vh] md:grid-cols-2 md:py-14">
      <div>
        <div class="eyebrow">Equal Educative Embrace</div>

        <h1 class="mt-4 text-3xl font-semibold leading-tight md:text-5xl">
          Literasi hukum yang tegas, riset yang relevan, kolaborasi yang berdampak.
        </h1>

        <p class="mt-4 max-w-xl text-slate-200">
          Edulaw Project memadukan edukasi publik, kajian berbasis data, dan ruang kolaborasi untuk memperkuat tata kelola hukum.
        </p>

        <div class="mt-8 flex flex-wrap gap-3">
          <a href="{{ route('program') }}" class="btn btn-primary">Program</a>
          <a href="{{ route('publikasi') }}" class="btn btn-ghost">Publikasi</a>
          <a href="{{ route('tentang') }}" class="btn btn-ghost">Kolaborasi</a>
        </div>
      </div>

      <div class="flex justify-center md:justify-end">
        <div class="w-full max-w-[640px] overflow-hidden rounded-3xl border border-white/10 bg-white/5 shadow-2xl">
          <img
            class="h-[340px] w-full object-cover sm:h-[420px] md:h-[560px]"
            src="{{ $hero ? asset('storage/'.$hero) : 'https://images.unsplash.com/photo-1523958203904-cdcb402031fd?q=80&w=1600&auto=format&fit=crop' }}"
            alt="Hero Edulaw"
          >
        </div>
      </div>
    </div>
  </div>
</section>


{{-- 2) PROGRAM --}}
<section class="section">
  <div class="container-edulaw">
    <div class="flex items-end justify-between gap-4">
      <div>
        <h2 class="text-xl font-semibold text-slate-900">Program Kami</h2>
        <p class="mt-1 text-sm text-slate-600">
          Empat jalur utama kerja Edulaw—dibuat ringkas, jelas, dan bisa ditindaklanjuti.
        </p>
      </div>
      <a class="text-sm font-semibold text-navy-900 hover:underline" href="{{ route('program') }}">
        Lihat Semua
      </a>
    </div>

    <div class="mt-6 grid gap-6 md:grid-cols-2">
      @foreach (['Kelas & Webinar','Konten Digital','Riset & Policy Brief','Kolaborasi'] as $item)
        <div class="card p-7">
          <div class="font-semibold text-slate-900">{{ $item }}</div>
          <p class="mt-2 text-sm text-slate-600">
            Ringkasan singkat program untuk membantu pengunjung memahami value-nya.
          </p>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- 3) EDULAW INSIGHT (preview) --}}
<section class="section">
  <div class="container-edulaw">
    <div class="flex items-end justify-between gap-4">
      <div>
        <div class="eyebrow">EDULAW INSIGHT</div>
        <h2 class="mt-2 text-xl font-semibold text-slate-900">Insight Terbaru</h2>
        <p class="mt-1 text-sm text-slate-600">
          Analisis singkat yang relevan untuk isu hukum, kebijakan, dan tata kelola.
        </p>
      </div>
      <a class="text-sm font-semibold text-navy-900 hover:underline" href="{{ route('insight.index') }}">
        Lihat Semua
      </a>
    </div>

    @if($latestInsights->isEmpty())
      <p class="mt-6 text-sm text-slate-500">Belum ada Insight terbaru.</p>
    @else
      <div class="mt-6 grid gap-6 md:grid-cols-3">
        @foreach($latestInsights as $insight)
          <a class="card p-6" href="{{ route('insight.show', $insight->slug) }}">
            <div class="eyebrow">EDULAW INSIGHT</div>
            <h3 class="mt-2 font-bold text-navy-950">{{ $insight->title }}</h3>

            <p class="mt-2 text-sm text-slate-600">
              {{ $insight->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($insight->content ?? ''), 120) }}
            </p>

            <div class="mt-4 text-xs text-slate-400">
              {{ $insight->published_at?->format('d M Y') ?? $insight->created_at?->format('d M Y') }}
            </div>
          </a>
        @endforeach
      </div>
    @endif
  </div>
</section>

{{-- 4) RISET & PUBLIKASI (preview) --}}
<section class="section">
  <div class="container-edulaw">
    <div class="flex items-end justify-between gap-4">
      <div>
        <h2 class="text-xl font-semibold text-slate-900">Riset & Publikasi</h2>
        <p class="mt-1 text-sm text-slate-600">
          Policy brief, paper, dan dokumen yang bisa diunduh untuk mendukung kerja akademik dan advokasi.
        </p>
      </div>
      <a href="{{ route('publikasi') }}" class="text-sm font-semibold text-navy-900 hover:underline">
        Lihat Semua
      </a>
    </div>

    <div class="mt-6 grid gap-4 md:grid-cols-3">
      @foreach ([
        ['title'=>'Policy Brief: Tata Kelola Data Publik', 'meta'=>'PDF • 1.2 MB • 2026', 'href'=>'#'],
        ['title'=>'Paper: Judicial Behaviour & Electoral Law', 'meta'=>'PDF • 900 KB • 2026', 'href'=>'#'],
        ['title'=>'Brief: Risiko Regulasi Fast-Track Legislation', 'meta'=>'DOCX • 450 KB • 2026', 'href'=>'#'],
      ] as $d)
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow">
          <div class="flex items-start justify-between gap-3">
            <div>
              <div class="font-semibold text-slate-900">{{ $d['title'] }}</div>
              <div class="mt-1 text-xs text-slate-500">{{ $d['meta'] }}</div>
            </div>
            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
              Download
            </span>
          </div>

          <div class="mt-4 flex items-center justify-between">
            <a href="{{ $d['href'] }}" class="rounded-lg bg-navy-900 px-4 py-2 text-sm font-semibold text-white hover:bg-navy-800">
              View Detail
            </a>
            <a href="{{ $d['href'] }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
              ⬇︎
            </a>
          </div>

          <p class="mt-3 text-xs text-slate-500">
            (Opsional) Nanti bisa dibuat wajib login untuk mengunduh + download counter.
          </p>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- 5) TENTANG KAMI --}}
<section class="section">
  <div class="container-edulaw">
    <div class="grid gap-10 md:grid-cols-2">
      <div>
        <h2 class="text-xl font-semibold text-slate-900">Tentang Kami</h2>
        <p class="mt-3 text-slate-600">
          Edulaw Project berfokus pada penguatan literasi konstitusi, advokasi kebijakan publik, dan riset hukum yang aplikatif.
          Melalui pendekatan kolaboratif dan berbasis data, kami membangun ekosistem pengetahuan hukum yang inklusif, kritis, dan relevan.
        </p>

        <ul class="mt-5 space-y-2 text-sm text-slate-700">
          <li class="flex gap-2"><span class="mt-1 h-2 w-2 rounded-full bg-gold-500"></span> Nilai inti: <span class="font-semibold">Equal Educative Embrace</span>.</li>
          <li class="flex gap-2"><span class="mt-1 h-2 w-2 rounded-full bg-gold-500"></span> Berbasis bukti: kutip sumber, jaga integritas.</li>
          <li class="flex gap-2"><span class="mt-1 h-2 w-2 rounded-full bg-gold-500"></span> Orientasi solusi: rekomendasi yang dapat dieksekusi.</li>
        </ul>
      </div>

      <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="grid grid-cols-3 gap-3">
          @foreach ([
            ['label'=>'Board','value'=>'21+'],
            ['label'=>'Member','value'=>'111'],
            ['label'=>'Participants','value'=>'3800+'],
            ['label'=>'Speakers','value'=>'23'],
            ['label'=>'Sessions','value'=>'50+'],
            ['label'=>'Downloads','value'=>'1000+'],
          ] as $s)
            <div class="rounded-2xl bg-slate-50 px-4 py-3">
              <div class="text-xs font-semibold text-slate-500">{{ $s['label'] }}</div>
              <div class="mt-1 text-lg font-semibold text-slate-900">{{ $s['value'] }}</div>
            </div>
          @endforeach
        </div>

        <div class="mt-6">
          <div class="text-sm font-semibold text-slate-900">Founder / Co-Founder</div>
          <div class="mt-3 flex flex-wrap gap-4">
            @foreach ([
              ['name'=>'Abdul Basid Fuadi'],
              ['name'=>'Azmi Fathur Rohman'],
              ['name'=>'Farez Almir'],
              ['name'=>'Umi Zakia'],
            ] as $f)
              <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-full bg-slate-200"></div>
                <div class="text-sm font-semibold text-slate-800">{{ $f['name'] }}</div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- 6) HUBUNGI KAMI --}}
<section class="bg-navy-950">
  <div class="mx-auto max-w-6xl px-4 py-14 text-slate-100">
    <div class="text-center">
      <h2 class="text-2xl font-semibold">Hubungi Kami</h2>
      <p class="mx-auto mt-2 max-w-2xl text-sm text-slate-200">
        Siap melangkah ke fase baru dalam pengembangan kompetensi hukum Anda?
        Hubungi kami untuk kolaborasi, pertanyaan program, atau permintaan riset.
      </p>
    </div>

    <div class="mx-auto mt-8 grid max-w-3xl gap-4 md:grid-cols-2">
      <a href="mailto:projectedulaw@gmail.com"
         class="rounded-2xl bg-white/10 px-5 py-4 text-center font-semibold hover:bg-white/15">
        Email: projectedulaw@gmail.com
      </a>
      <a href="#"
         class="rounded-2xl px-5 py-4 text-center font-semibold text-navy-950 hover:opacity-95"
         style="background:#26C467;">
        Hubungi via WhatsApp
      </a>
    </div>

    <p class="mt-4 text-center text-xs text-slate-300">
      SLA respons: biasanya 1×24 jam pada hari kerja.
    </p>
  </div>
</section>
@endsection
