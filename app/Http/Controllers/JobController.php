<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $title = 'Available Jobs';
        $jobs = [
            'Software Engineer',
            'Cybersecurity',
            'Graphic Designer',
            'UI/UX Designer'
        ];

        return view('/jobs.index', compact('title', 'jobs'));
    }

    public function create()
    {
        return view('/jobs.create');
    }

    public function show(string $id)
    {
        return "Job Id: $id";
    }

    public function store(Request $request)
    {
        $title = $request->input('title');
        $description = $request->input('description');

        return "Job title: $title <br /> Job description: $description";
    }
}
