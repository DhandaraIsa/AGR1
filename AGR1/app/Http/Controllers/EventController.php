<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('status', 1)
            ->orderBy('date_start')
            ->get();

        return view('pages.eventos', compact('events'));
    }
}