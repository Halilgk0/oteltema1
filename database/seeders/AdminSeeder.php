<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // admin123 is only a local-development default; set ADMIN_PASSWORD on any public deployment
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'admin123')),
                'phone' => '+905555555555',
            ]
        );

        // is_admin isn't mass assignable, so set it directly
        $admin->forceFill(['is_admin' => true])->save();
    }
} 