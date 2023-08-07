<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::class::create(['name' => 'admin']);

        User::class::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
            'phone' => '123123123',
            'role_id' => $adminRole->id
        ]);
    }
}
