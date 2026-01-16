<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramAdminController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy('sort_order')->latest()->paginate(20);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'excerpt' => ['nullable','string','max:500'],
            'body' => ['nullable','string'],
            'cta_label' => ['nullable','string','max:40'],
            'cta_url' => ['nullable','string','max:255'],
            'sort_order' => ['nullable','integer','min:0','max:9999'],
            'is_active' => ['nullable'],

            'cover_image' => ['nullable','image','max:2048'],
        ]);

        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('programs', 'public');
        }

        Program::create($data);

        return redirect()->route('admin.programs.index')->with('status','Program dibuat.');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'excerpt' => ['nullable','string','max:500'],
            'body' => ['nullable','string'],
            'cta_label' => ['nullable','string','max:40'],
            'cta_url' => ['nullable','string','max:255'],
            'sort_order' => ['nullable','integer','min:0','max:9999'],
            'is_active' => ['nullable'],

            'cover_image' => ['nullable','image','max:2048'],
        ]);

        if ($data['title'] !== $program->title) {
            $data['slug'] = $this->uniqueSlug($data['title'], $program->id);
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            if ($program->cover_image) {
                Storage::disk('public')->delete($program->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('programs', 'public');
        }

        $program->update($data);

        return redirect()->route('admin.programs.index')->with('status','Program diperbarui.');
    }

    public function destroy(Program $program)
    {
        if ($program->cover_image) {
            Storage::disk('public')->delete($program->cover_image);
        }
        $program->delete();

        return redirect()->route('admin.programs.index')->with('status','Program dihapus.');
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 2;

        while (
            Program::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id','!=',$ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$i;
            $i++;
        }
        return $slug;
    }
}
