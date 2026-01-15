<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Admin • Moderasi Opini</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('status'))
                <div class="p-4 rounded bg-green-50 text-green-800">{{ session('status') }}</div>
            @endif

            <div class="bg-white shadow rounded p-4 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <form class="flex gap-2">
                    <input name="q" value="{{ request('q') }}" class="rounded border-slate-300" placeholder="Cari judul...">
                    <select name="status" class="rounded border-slate-300">
                        <option value="">Semua status</option>
                        @foreach(['submitted','reviewed','published','rejected'] as $s)
                            <option value="{{ $s }}" @selected(request('status')===$s)>{{ $s }}</option>
                        @endforeach
                    </select>
                    <button class="px-3 py-2 rounded bg-slate-900 text-white">Filter</button>
                </form>

                <div class="text-sm text-slate-600">
                    Total: {{ $opinions->total() }}
                </div>
            </div>

            <div class="bg-white shadow rounded overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-700">
                        <tr>
                            <th class="text-left p-3">Judul</th>
                            <th class="text-left p-3">Pengirim</th>
                            <th class="text-left p-3">Status</th>
                            <th class="text-left p-3">Tanggal</th>
                            <th class="p-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($opinions as $op)
                            <tr class="border-t">
                                <td class="p-3 font-medium">{{ $op->title }}</td>
                                <td class="p-3 text-slate-600">
                                    @if($op->user)
                                        {{ $op->user->name }} (user)
                                    @else
                                        {{ $op->guest_name }} (guest)
                                    @endif
                                </td>
                                <td class="p-3">
                                    <span class="px-2 py-1 rounded bg-slate-100">{{ $op->status }}</span>
                                </td>
                                <td class="p-3 text-slate-600">{{ $op->created_at->format('d M Y') }}</td>
                                <td class="p-3 text-right">
                                    <a class="underline" href="{{ route('admin.opinions.show', $op->slug) }}">Buka</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div>{{ $opinions->links() }}</div>
        </div>
    </div>
</x-app-layout>
