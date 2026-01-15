@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl p-6">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Admin · Insights</h1>
        <a href="{{ route('admin.insights.create') }}" class="rounded-lg bg-navy-900 px-4 py-2 text-sm font-semibold text-white">
            + Insight Baru
        </a>
    </div>

    @if(session('status'))
        <div class="mt-4 rounded-lg bg-emerald-50 p-3 text-sm text-emerald-800">{{ session('status') }}</div>
    @endif

    <div class="mt-6 overflow-hidden rounded-2xl border bg-white">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="p-3 text-left">Judul</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Publish</th>
                    <th class="p-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($insights as $i)
                <tr class="border-t">
                    <td class="p-3">
                        <div class="font-semibold">{{ $i->title }}</div>
                        <div class="text-xs text-slate-500">/{{ $i->slug }}</div>
                    </td>
                    <td class="p-3">
                        <span class="rounded-full px-2 py-1 text-xs {{ $i->status==='published' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-700' }}">
                            {{ $i->status }}
                        </span>
                    </td>
                    <td class="p-3 text-slate-600">
                        {{ $i->published_at ? $i->published_at->format('Y-m-d H:i') : '-' }}
                    </td>
                    <td class="p-3 text-right">
                        <a class="mr-3 text-navy-900 hover:underline" href="{{ route('admin.insights.edit', $i) }}">Edit</a>
                        <form class="inline" method="POST" action="{{ route('admin.insights.destroy', $i) }}" onsubmit="return confirm('Hapus insight ini?')">
                            @csrf @method('DELETE')
                            <button class="text-rose-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $insights->links() }}</div>
</div>
@endsection
