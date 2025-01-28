<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    // @desc Get all user bookmarked jobs
    // @route GET /bookmarks
    public function index(): View
    {
        // Get authenticated user
        $user = Auth::user();

        // Get bookmarked job listings
        $bookmarks = $user->bookmarkedJobs()->paginate(9);
        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }
}
