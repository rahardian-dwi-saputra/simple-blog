<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('users')->insert([
        	[
            	'name' => 'Admin',
            	'username' => 'admin',
            	'email' => 'radiandwi2206@gmail.com',
            	'is_admin' => 1,
            	'can_delete' => 0,
            	'password' => Hash::make('admin')
        	],
        	[
        		'name' => 'User',
            	'username' => 'user',
            	'email' => 'user@gmail.com',
            	'is_admin' => 0,
            	'can_delete' => 0,
            	'password' => Hash::make('user')
        	]
        ]);
    }
}
