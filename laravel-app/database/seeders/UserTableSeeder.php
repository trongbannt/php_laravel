<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create([
            'name'    => 'user001',
            'email'    => 'user001@gmail.com',
            'password'   =>  Hash::make('12345678'),
            'remember_token' =>   Str::random(10),
        ]);

        User::create([
            'name'    => 'user002',
            'email'    => 'user002@gmail.com',
            'password'   =>  Hash::make('12345678'),
            'remember_token' =>   Str::random(10),
        ]);

        User::create([
            'name'    => 'user003',
            'email'    => 'user003@gmail.com',
            'password'   =>  Hash::make('12345678'),
            'remember_token' =>   Str::random(10),
        ]);
    }
}
