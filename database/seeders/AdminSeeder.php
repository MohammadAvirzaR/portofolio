<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin Account
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@portfolio.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Guest Account (example)
        User::create([
            'name' => 'Guest User',
            'email' => 'guest@portfolio.com',
            'password' => Hash::make('guest123'),
            'role' => 'guest',
        ]);

        echo "✅ Admin and Guest accounts created successfully!\n";
        echo "📧 Admin: admin@portfolio.com | Password: admin123\n";
        echo "📧 Guest: guest@portfolio.com | Password: guest123\n";
    }
}
