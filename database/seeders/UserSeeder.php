<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'sarpras',
            'email' => 'sarpras@smkn1-sby.sch.id',
            'level' => 'admin',
            'password' => Hash::make('sarpras123'),
        ]);
    }
}
