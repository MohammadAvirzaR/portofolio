<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NewAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin Account
        User::updateOrCreate(
            ['email' => 'superadmin@jobportal.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('superadmin123'),
                'role' => 'admin',
            ]
        );

        // Create Admin Account - Job Portal Manager
        User::updateOrCreate(
            ['email' => 'manager@jobportal.com'],
            [
                'name' => 'Job Portal Manager',
                'password' => Hash::make('manager123'),
                'role' => 'admin',
            ]
        );

        // Create HR Admin Account
        User::updateOrCreate(
            ['email' => 'hr@jobportal.com'],
            [
                'name' => 'HR Administrator',
                'password' => Hash::make('hradmin123'),
                'role' => 'admin',
            ]
        );

        // Create Regular User Accounts
        User::updateOrCreate(
            ['email' => 'user@jobportal.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('user123'),
                'role' => 'guest',
            ]
        );

        User::updateOrCreate(
            ['email' => 'jobseeker@jobportal.com'],
            [
                'name' => 'Job Seeker',
                'password' => Hash::make('jobseeker123'),
                'role' => 'guest',
            ]
        );

        echo "\n";
        echo "✅ New accounts created/updated successfully!\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "👑 ADMIN ACCOUNTS:\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "📧 Email: superadmin@jobportal.com\n";
        echo "🔑 Password: superadmin123\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "📧 Email: manager@jobportal.com\n";
        echo "🔑 Password: manager123\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "📧 Email: hr@jobportal.com\n";
        echo "🔑 Password: hradmin123\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "\n";
        echo "👤 USER ACCOUNTS:\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "📧 Email: user@jobportal.com\n";
        echo "🔑 Password: user123\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "📧 Email: jobseeker@jobportal.com\n";
        echo "🔑 Password: jobseeker123\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "\n";
    }
}
