<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InsightAdminController extends Controller
{
    public function index()
    {
        $insights = Insight::latest()->paginate(15);

        return view('admin.insights.index', compact('insights'));
    }

    public function create()
    {
        return view('admin.insights.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'excerpt'     => ['nullable', 'string', 'max:500'],
            'body'        => ['required', 'string'],
            'status'      => ['required', 'in:draft,published'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
        ]);

        $data['user_id'] = auth()->id();
        $data['slug']    = $this->uniqueSlug($data['title']);

        // Auto excerpt jika kosong
        if (blank($data['excerpt'] ?? null)) {
            $data['excerpt'] = $this->makeExcerpt($data['body']);
        }

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('insights', 'public');
        }

        $data['published_at'] = ($data['status'] === 'published') ? now() : null;

        Insight::create($data);

        return redirect()
            ->route('admin.insights.index')
            ->with('status', 'Insight dibuat.');
    }

    public function edit(Insight $insight)
    {
        return view('admin.insights.edit', compact('insight'));
    }

    public function update(Request $request, Insight $insight)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'excerpt'     => ['nullable', 'string', 'max:500'],
            'body'        => ['required', 'string'],
            'status'      => ['required', 'in:draft,published'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
        ]);

        // Update slug jika title berubah
        if ($data['title'] !== $insight->title) {
            $data['slug'] = $this->uniqueSlug($data['title'], $insight->id);
        }

        // Auto excerpt jika kosong
        if (blank($data['excerpt'] ?? null)) {
            $data['excerpt'] = $this->makeExcerpt($data['body']);
        }

        // Update cover image
        if ($request->hasFile('cover_image')) {
            if ($insight->cover_image) {
                Storage::disk('public')->delete($insight->cover_image);
            }

            $data['cover_image'] = $request->file('cover_image')->store('insights', 'public');
        }

        // Publish logic
        if ($data['status'] === 'published' && !$insight->published_at) {
            $data['published_at'] = now();
        }

        if ($data['status'] === 'draft') {
            $data['published_at'] = null;
        }

        $insight->update($data);

        return redirect()
            ->route('admin.insights.index')
            ->with('status', 'Insight diperbarui.');
    }

    public function destroy(Insight $insight)
    {
        if ($insight->cover_image) {
            Storage::disk('public')->delete($insight->cover_image);
        }

        $insight->delete();

        return redirect()
            ->route('admin.insights.index')
            ->with('status', 'Insight dihapus.');
    }

    /**
     * Preview insight untuk admin (boleh draft maupun published)
     */
    public function preview(Insight $insight)
    {
        return view('pages.insight-show', compact('insight'));
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i    = 2;

        while (
            Insight::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }

    private function makeExcerpt(string $html, int $limit = 180): string
    {
        $text = trim(strip_tags($html));
        $text = preg_replace('/\s+/', ' ', $text);

        if (mb_strlen($text) <= $limit) {
            return $text;
        }

        return mb_substr($text, 0, $limit - 1) . '…';
    }
}
