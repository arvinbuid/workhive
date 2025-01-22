<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Clear table data if there is any before adding new fields
        DB::table('job_listings')->truncate();

        Schema::table('job_listings', function (Blueprint $table) {
            // salary, tags, job_type, remote, requirements, benefits, address, city, state, zipcode, contact_email, contact_phone
            // company_name, company description, company_logo, company_website
            $table->unsignedBigInteger('user_id')->after('id');

            $table->integer('salary');
            $table->string('tags')->nullable(); // nullable means that the field is not required
            $table->enum('job_type', ['Full-Time', 'Part-Time', 'Contract', 'On-Call', 'Temporary', 'Internship', 'Volunteer'])->default('Full-Time');
            $table->boolean('remote')->default(false);
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->string('address')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zipcode')->nullable();
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->string('company_name');
            $table->text('company_description')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_website')->nullable();

            // Add user foreign key restraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->dropColumn(['salary', 'tags', 'job_type', 'remote', 'requirements', 'benefits', 'address', 'city', 'state', 'zipcode', 'contact_email', 'contact_phone', 'company_name', 'company_description', 'company_logo', 'company_website']);
        });
    }
};
