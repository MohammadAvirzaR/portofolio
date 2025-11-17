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
        Schema::table('applications', function (Blueprint $table) {
            // Tambah kolom jika belum ada
            if (!Schema::hasColumn('applications', 'cv_path')) {
                $table->string('cv_path')->nullable()->after('job_posting_id');
            }
            if (!Schema::hasColumn('applications', 'status')) {
                $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending')->after('cv_path');
            }
            if (!Schema::hasColumn('applications', 'admin_notes')) {
                $table->text('admin_notes')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Drop kolom jika ada
            if (Schema::hasColumn('applications', 'cv_path')) {
                $table->dropColumn('cv_path');
            }
            if (Schema::hasColumn('applications', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('applications', 'admin_notes')) {
                $table->dropColumn('admin_notes');
            }
        });
    }
};
