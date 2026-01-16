<?php

namespace App\Http\Controllers;

use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::where('is_active', true)
            ->orderBy('sort_order')
            ->latest('id')
            ->get();

        return view('pages.program', compact('programs'));
    }
}
