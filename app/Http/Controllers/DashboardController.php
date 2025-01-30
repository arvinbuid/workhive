<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;

class DashboardController extends Controller
{
    // @desc Show user dashboard
    // @route GET /dashboard
    public function index(): View
    {
        // Get user id
        $user = Auth::user();

        // Get user job listings
        $jobs = Job::where('user_id', $user->id)->with('applicants')->get();

        return view('dashboard.index', compact('user', 'jobs'));
    }
}
