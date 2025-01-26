<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    // @desc    Show all job listings
    // @route   GET /jobs
    public function index(): View
    {
        $jobs = Job::all();

        // return view('jobs.index', compact('jobs'));
        return view('jobs.index')->with('jobs', $jobs);
    }

    // @desc    Show create job form
    // @route   GET /jobs/create
    public function create()
    {
        return view('jobs.create');
    }

    // @desc    Save job to database
    // @route   POST /jobs
    public function store(Request $request): RedirectResponse
    {
        // Add validation before creating a new job listing
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);

        // Assign job listing to currently logged in user
        $validatedData['user_id'] = Auth::user()->id;

        // Check for image
        if ($request->hasFile('company_logo')) {
            // Store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path to validated data
            $validatedData['company_logo'] = $path;
        }

        // Submit to database
        Job::create($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job listing created successfully.');
    }

    // @desc    Display a single job listing
    // @route   GET /jobs/{$id}
    public function show(Job $job): View // Model Binding makes this process easier and clean.
    {
        return view('jobs.show')->with('job', $job);
    }

    // @desc    Show edit job form
    // @route   GET /jobs/{$id}/edit
    public function edit(Job $job)
    {
        return view('jobs.edit')->with('job', $job);
    }

    // @desc    Update job listing
    // @route   PUT /jobs/{$id}
    public function update(Request $request, Job $job)
    {
        // Add validation before creating a new job listing
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);

        // Check for image
        if ($request->hasFile('company_logo')) {
            // Delete company logo if already exists
            Storage::delete('public/logos/' . basename($job->company_logo));

            // Store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path to validated data
            $validatedData['company_logo'] = $path;
        }

        // Update job and submit to database
        $job->update($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job listing updated successfully.');
    }

    // @desc    Delete a job listing
    // @route   DELETE /jobs/{$id}
    public function destroy(Job $job): RedirectResponse
    {
        // Delete company logo if already exists
        Storage::delete('public/logos/' . basename($job->company_logo));

        // Delete job
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job listing deleted successfully.');
    }
}
