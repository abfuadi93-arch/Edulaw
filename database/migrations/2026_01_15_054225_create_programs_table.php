<?php

namespace App\Http\Controllers;

use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view('pages.program', compact('programs'));
    }
}
