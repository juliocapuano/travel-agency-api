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
        Role::factory()->create(['name' => 'admin']);
        Role::factory()->create(['name' => 'editor']);

        User::factory()->create([
            'name'     => 'Admin User',
            'email'    => 'admin@admin.com',
            'password' => \Hash::make('password'),
        ])->roles()->sync(Role::all());
    }
}
