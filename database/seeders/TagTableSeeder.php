<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'name' => 'river',            
        ]);
        
        DB::table('tags')->insert([
            'name' => 'ocean',            
        ]);
        
        DB::table('tags')->insert([
            'name' => 'forest',            
        ]);
        
        DB::table('tags')->insert([
            'name' => 'cityscape',            
        ]);
        
        DB::table('tags')->insert([
            'name' => 'mountain',    
        ]);
            
    }
}
