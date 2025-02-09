<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'id' => Role::ADMIN,
            'name' => 'Admin',
            'description' => 'Administrator',
        ]);

        Role::create([
            'id' => Role::USER,
            'name' => 'User',
            'description' => 'Regular User',
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role_id' => Role::ADMIN,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => Role::USER,
        ]);

        $this->call([
            NotificationSeeder::class,
        ]);
    }
}
