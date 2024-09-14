<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([ 
        	[
        		'name' => 'Teknologi Informasi',
        		'slug' => 'teknologi-informasi'
        	],[
        		'name' => 'Ekonomi dan bisnis',
        		'slug' => 'ekonomi-dan-bisnis'
        	],[
        		'name' => 'Psikologi',
        		'slug' => 'psikologi'
        	],[
        		'name' => 'Kesehatan',
        		'slug' => 'kesehatan'
        	],[
        		'name' => 'Hobby',
        		'slug' => 'hobby'
        	]
        ]);
    }
}
