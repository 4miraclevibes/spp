<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            [
                'name' => 'KELAS SATU',
                'teacher_id' => 1
            ],
            [
                'name' => 'KELAS DUA',
                'teacher_id' => 2
            ],
            [
                'name' => 'KELAS TIGA',
                'teacher_id' => 3
            ],
            [
                'name' => 'KELAS EMPAT',
                'teacher_id' => 4
            ],
            [
                'name' => 'KELAS LIMA',
                'teacher_id' => 5
            ],
            [
                'name' => 'KELAS ENAM',
                'teacher_id' => 6
            ],
            [
                'name' => 'KELAS TUJUH',
                'teacher_id' => 7
            ],
            [
                'name' => 'KELAS DELAPAN',
                'teacher_id' => 8
            ],
            [
                'name' => 'KELAS SEMBILAN',
                'teacher_id' => 9
            ],
            [
                'name' => 'KELAS SEPULUH',
                'teacher_id' => 10
            ],
            [
                'name' => 'KELAS SEBELAS',
                'teacher_id' => 11
            ],
            [
                'name' => 'KELAS DUABELAS',
                'teacher_id' => 12
            ]
        ];
        foreach ($grades as $grade) {
            DB::table('grades')->insert([
                'name' => $grade['name'],
                'teacher_id' => $grade['teacher_id']
            ]);
        }
    }
}
