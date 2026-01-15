<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use Illuminate\Http\Request;

class OpinionController extends Controller
{
    // Halaman Edulaw Insight (hanya yang published)
    public function insightIndex()
    {
        $opinions = Opinion::published()
            ->latest('published_at')
            ->paginate(9);

        return view('pages.insight', compact('opinions'));
    }

    // Detail Insight
    public function insightShow(Opinion $opinion)
    {
        abort_unless($opinion->status === Opinion::STATUS_PUBLISHED && $opinion->published_at, 404);

        return view('pages.insight-show', compact('opinion'));
    }

    // Form Kirim Opini
    public function create()
    {
        return view('pages.kirim-opini');
    }

    // Simpan opini (boleh guest; jika guest wajib isi nama+email)
public function store(Request $request)
{
    $data = $request->validate([
        'title'   => ['required', 'string', 'max:160'],
        'content' => ['required', 'string', 'min:50'],
    ]);

    $opinion = new Opinion();
    $opinion->user_id = auth()->id();
    $opinion->title   = $data['title'];
    $opinion->slug    = Opinion::makeUniqueSlug($data['title']);
    $opinion->content = $data['content'];

    $opinion->status = Opinion::STATUS_SUBMITTED;
    $opinion->save();

    return redirect()->route('kirim-opini')
        ->with('status', 'Opini berhasil dikirim. Terima kasih! Tim kami akan meninjau.');
}

}
