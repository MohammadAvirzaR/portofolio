<?php

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
        Schema::table('job_postings', function (Blueprint $table) {
            // Add job_type column (enum: full-time, part-time, contract, internship, freelance)
            $table->enum('job_type', ['full-time', 'part-time', 'contract', 'internship', 'freelance'])
                  ->default('full-time')
                  ->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropColumn('job_type');
        });
    }
};
