<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opinion;
use Illuminate\Http\Request;

class AdminOpinionController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = Opinion::query()->latest();

        if ($status) {
            $query->where('status', $status);
        }

        if ($q = $request->query('q')) {
            $query->where('title', 'like', "%{$q}%");
        }

        $opinions = $query->paginate(12)->withQueryString();

        return view('admin.opinions.index', compact('opinions', 'status'));
    }

    public function show(Opinion $opinion)
    {
        return view('admin.opinions.show', compact('opinion'));
    }

    public function update(Request $request, Opinion $opinion)
    {
        $data = $request->validate([
            'status' => ['required', 'in:submitted,reviewed,published,rejected'],
            'admin_note' => ['nullable', 'string', 'max:2000'],
        ]);

        $opinion->status = $data['status'];
        $opinion->admin_note = $data['admin_note'] ?? null;

        if ($data['status'] === Opinion::STATUS_PUBLISHED) {
            $opinion->published_at = $opinion->published_at ?? now();
        } else {
            $opinion->published_at = null;
        }

        $opinion->save();

        return back()->with('status', 'Status opini diperbarui.');
    }
}
