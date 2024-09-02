<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('student_fees')->insert([
            'price' => 200000,
            'name' => 'SPP SD',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
