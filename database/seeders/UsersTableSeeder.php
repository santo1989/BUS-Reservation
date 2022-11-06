<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => 1,
            'name' => 'Admin',
            'email' => 'santo.botany@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 1,
            'name' => 'Admin',
            'email' => 'ismat.fj@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 1,
            'name' => 'Admin',
            'email' => 'nathan@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('nathanusa'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'Driver',
            'email' => 'dr1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 3,
            'name' => 'Passenger',
            'email' => 'ali@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => 3,
            'name' => 'Passenger',
            'email' => 'md@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
        ]);
    }
}
