<?php

namespace App\Http\Controllers;

use App\Models\Congress;

class CongressController extends Controller
{
    public function index()
    {
        $congresses = Congress::where('status', 1)
            ->orderBy('date_start', 'asc')
            ->get();

        return view('pages.congressos', compact('congresses'));
    }
}