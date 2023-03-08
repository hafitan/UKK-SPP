<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            [
                'username' => 'hafitan',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'level' => 'admin'
            ],
            [
                'username' => 'Balance',
                'email' => 'petugas@gmail.com',
                'password' => Hash::make('password'),
                'level' => 'petugas'
            ],
        ]);
    }
}
