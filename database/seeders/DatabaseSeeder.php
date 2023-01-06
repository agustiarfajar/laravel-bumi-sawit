<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'username' => 'daul',
            'no_telp' => mt_rand(0000000000000, 999999999999),
            'nama' => 'Bang Daul',
            'email' => 'daul@gmail.com',
            'password' => Hash::make('@Daul123'),
            'role' => 'user',
        ]);

        DB::table('users')->insert([
            'username' => 'admin',
            'no_telp' => mt_rand(0000000000000, 999999999999),
            'nama' => 'Admin Bumi Sawit',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('@Admin123'),
            'role' => 'admin',
        ]);
    }
}
