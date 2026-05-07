<?php

namespace App\Http\Controllers;

use App\Models\Plan;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::orderBy('display_order')->get();

        return view('pages.plans', compact('plans'));
    }
}