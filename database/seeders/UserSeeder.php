<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // seed admin user
        User::create([
            'email'=>config('variables.admin_email'),
            'password'=>'admin',
            'role'=>'administrator'
        ]);
    }
}
