<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.cursos', compact('courses'));
    }
}