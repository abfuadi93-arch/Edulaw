<?php

namespace App\Http\Controllers;

use App\Models\Insight;

class HomeController extends Controller
{
    public function index()
    {
        $latestInsights = Insight::where('status','published')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.home', compact('latestInsights'));
    }
}
