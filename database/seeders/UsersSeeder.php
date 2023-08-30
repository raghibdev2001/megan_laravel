<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            'name' => 'superadmin',
            'email' => 'superadmin@cybertronlabs.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
