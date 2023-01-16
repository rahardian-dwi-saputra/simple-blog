<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('categories')->insert([ 
        	[
        		'name' => 'Teknologi Informasi',
        		'slug' => 'teknologi-informasi'
        	],[
        		'name' => 'Ekonomi dan bisnis',
        		'slug' => 'teknologi-dan-bisnis'
        	],[
        		'name' => 'Psikologi',
        		'slug' => 'psikologi'
        	],[
        		'name' => 'Berita',
        		'slug' => 'berita'
        	],[
        		'name' => 'Traveling',
        		'slug' => 'traveling'
        	]
        ]);
    }
}
