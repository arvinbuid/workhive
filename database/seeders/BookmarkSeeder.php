<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Job;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first user
        $firstUser = User::where('email', 'skadi@example.com')->firstOrFail();

        // Get all job ids
        $jobIds = Job::pluck('id')->toArray();

        // Randomly select job ids to bookmark
        $randomJobIds = array_rand($jobIds, 3);

        // Attach the selected jobs as bookmark for the first user
        foreach ($randomJobIds as $jobId) {
            $firstUser->bookmarkedJobs()->attach($jobIds[$jobId]);
        }
    }
}
