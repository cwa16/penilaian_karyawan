<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){
 DB::table('performance_criteria')->insert([
 ['code'=>'K1','name'=>'Kualitas Pekerjaan','weight'=>10],
 ['code'=>'K2','name'=>'Kuantitas Pekerjaan','weight'=>10],
 ...
 ]);
    }
}
