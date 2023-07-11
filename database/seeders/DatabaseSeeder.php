<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Ryan Howard',
            'email' => 'ryan@xedi.com',
            'password' => '$2y$10$7fQOPXnMBwtcqV2Z27IiTuPx.wWlff17X/NMWjj2dip93IaO7pcIe'
        ]);
    }
}
