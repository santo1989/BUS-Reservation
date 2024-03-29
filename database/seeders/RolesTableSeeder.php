<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin'
        ]);

        Role::create([
            'name' => 'Driver'
        ]);

        Role::create([
            'name' => 'Passenger'
        ]);

        Role::create([
            'name' => 'Guest'
        ]);
    }
}
