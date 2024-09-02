<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = User::where('role', 'TEACHER')->get();
        foreach ($teachers as $teacher) {
            Teacher::create([
                'user_id' => $teacher->id,
                'phone' => '081234567890',
                'address' => 'Jl. Admin'
            ]);
        }
    }
}
