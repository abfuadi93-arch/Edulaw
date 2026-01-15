<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Admin • Detail Opini</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('status'))
                <div class="p-4 rounded bg-green-50 text-green-800">{{ session('status') }}</div>
            @endif

            <div class="bg-white shadow rounded p-6">
                <div class="text-sm text-slate-600">
                    Pengirim:
                    @if($opinion->user)
                        {{ $opinion->user->name }} ({{ $opinion->user->email }})
                    @else
                        {{ $opinion->guest_name }} ({{ $opinion->guest_email }})
                    @endif
                </div>

                <h1 class="mt-3 text-2xl font-semibold">{{ $opinion->title }}</h1>

                <div class="mt-4 whitespace-pre-wrap text-slate-800">{{ $opinion->content }}</div>
            </div>

            <div class="bg-white shadow rounded p-6">
                <form method="POST" action="{{ route('admin.opinions.update', $opinion->slug) }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium">Status</label>
                        <select name="status" class="mt-1 rounded border-slate-300">
                            @foreach(['submitted','reviewed','published','rejected'] as $s)
                                <option value="{{ $s }}" @selected($opinion->status===$s)>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Catatan Admin (opsional)</label>
                        <textarea name="admin_note" rows="4" class="mt-1 w-full rounded border-slate-300">{{ old('admin_note', $opinion->admin_note) }}</textarea>
                    </div>

                    <button class="px-4 py-2 rounded bg-slate-900 text-white">Simpan</button>

                    @if($opinion->status === 'published')
                        <a class="ml-3 underline" href="{{ route('insight.show', $opinion->slug) }}" target="_blank">Lihat di Insight</a>
                    @endif
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
