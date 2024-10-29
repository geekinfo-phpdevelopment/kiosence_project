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
        Role::factory()->create([
            'name'=> 'Super Admin'
        ]);
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@webinfosoftwares.com',
            'password'=>'Admin@0510224',
            'role_id'=>1
        ]);
    }
}
