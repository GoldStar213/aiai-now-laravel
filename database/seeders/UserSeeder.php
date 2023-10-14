<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'ユーザー', 
            'email' => 'user@user.com', 
            'email_verified_at' => new \DateTime(), 
            'password' => bcrypt('password')
        ]);

        if (env('LOCAL_TEST')) {
            \App\Models\User::create([
                'name' => 'usre02', 
                'email' => 'user02@localhost.com', 
                'email_verified_at' => new \DateTime(), 
                'password' => bcrypt('password')
            ]);

            // \App\Models\User::create([
            //     'name' => 'usre03', 
            //     'email' => 'user03@localhost.com', 
            //     'email_verified_at' => new \DateTime(), 
            //     'password' => bcrypt('password')
            // ]);
        } else {
            \App\Models\User::create([
                'name' => '358rocke', 
                'email' => '358rocke@gmail.com', 
                'email_verified_at' => new \DateTime(), 
                'password' => bcrypt('password')
            ]);

            \App\Models\User::create([
                'name' => 'aketchi-07', 
                'email' => 'aketchi.07@gmail.com', 
                'email_verified_at' => new \DateTime(), 
                'password' => bcrypt('password')
            ]);            
        }
    }
}
