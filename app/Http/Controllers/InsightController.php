<?php

namespace App\Http\Controllers;

use App\Models\Insight;

class InsightController extends Controller
{
    public function index()
    {
        $insights = Insight::where('status','published')
            ->latest('published_at')
            ->paginate(9);

        return view('pages.insight-index', compact('insights'));
    }

    public function show(string $slug)
    {
        $insight = Insight::where('slug', $slug)
            ->where('status','published')
            ->firstOrFail();

        return view('pages.insight-show', compact('insight'));
    }
}
