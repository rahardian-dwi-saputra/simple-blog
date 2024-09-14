<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        	[
            	'name' => 'Admin',
            	'username' => 'admin',
            	'email' => 'admin@test.com',
                'email_verified_at' => Carbon::now(),
            	'is_admin' => true,
            	'password' => Hash::make('admin'),
            	'can_delete' => false
        	],
        	[
        		'name' => 'User',
            	'username' => 'user',
            	'email' => 'user@test.com',
                'email_verified_at' => Carbon::now(),
            	'is_admin' => false,
            	'password' => Hash::make('user'),
            	'can_delete' => false
        	],
            [
                'name' => 'Tester',
                'username' => 'tester',
                'email' => 'tester@test.com',
                'email_verified_at' => Carbon::now(),
                'is_admin' => false,
                'password' => Hash::make('tester'),
                'can_delete' => false
            ]
        ]);
    }
}
