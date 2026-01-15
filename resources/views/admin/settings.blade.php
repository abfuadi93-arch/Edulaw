<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">Admin • Pengaturan Situs</h2>
  </x-slot>

  <div class="py-8">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
      @if (session('status'))
        <div class="p-4 rounded bg-green-50 text-green-800">{{ session('status') }}</div>
      @endif

      <div class="p-6 bg-white shadow rounded">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
          @csrf

          <div>
            <label class="block font-medium mb-2">Gambar Hero (Beranda)</label>
            @if($hero)
              <img src="{{ asset('storage/'.$hero) }}" class="rounded mb-3" style="max-height:220px;">
            @endif
            <input type="file" name="hero_image" class="block w-full">
            @error('hero_image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
          </div>

          <div>
            <label class="block font-medium mb-2">Gambar Tentang Kami</label>
            @if($about)
              <img src="{{ asset('storage/'.$about) }}" class="rounded mb-3" style="max-height:220px;">
            @endif
            <input type="file" name="about_image" class="block w-full">
            @error('about_image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
          </div>

          <button class="px-4 py-2 rounded bg-slate-900 text-white">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
