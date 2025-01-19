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
}
