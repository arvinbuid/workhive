<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load job listings from the file.
        $jobListings = include database_path('seeders/data/job_listings.php');

        // Get test user id
        $testUserId = User::where('email', 'test@example.com')->value('id');

        // Get all other user ids from the user model excluding $testUserId
        $userIds = User::where('email', '!=', 'test@example.com')->pluck('id')->toArray();

        // Loop through job listings
        foreach ($jobListings as $index => &$listing) {
            if ($index < 2) {
                // Assign the first test user to the first 2 job listings
                $listing['user_id'] = $testUserId;
            } else {
                // Assign user id to listing
                $listing['user_id'] = $userIds[array_rand($userIds)];
            }

            // Add timestamps
            $listing['created_at'] = now();
            $listing['updated_at'] = now();
        }

        // Insert job listing into db
        DB::table('job_listings')->insert($jobListings);
        echo 'Job created succesfully';
    }
}
