<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'System administrator with full access',
        ]);

        $admin = User::firstOrCreate(
            ['email' => 'CEO@zeno-sphere.com'],

            [
                'name' => 'Vedaste',
                'password' => Hash::make('password123'),
            ]
        );

        if (!$admin->hasRole('admin')) {
            $admin->addRole($adminRole);
        }
    }
}