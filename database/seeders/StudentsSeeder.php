<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 11; $i++) {
            $user = User::create([
                'email'=>$i.'@m.c',
                'password'=>'000',
                'role'=>'student'
            ]);

            Profile::create([
                'user_id'=>$user->id,
                'classroom_id'=>0,
                'first_name'=>fake()->firstName,
                'middle_name'=>fake()->lastName,
                'last_name'=>fake()->lastName,
                'birthday'=>fake()->date,
                'house_and_street'=>fake()->streetAddress,
                'city_or_municipality'=>fake()->city,
                'province'=>fake()->country,
            ]);
        }
        
    }
}
