<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Db;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Truncate tables
        DB::table('job_listings')->truncate();
        DB::table('users')->truncate();

        // Call RandomUserSeeder and JobSeeder to seed the users and job_listings table
        $this->call(RandomUserSeeder::class);
        $this->call(JobSeeder::class);
    }
}
