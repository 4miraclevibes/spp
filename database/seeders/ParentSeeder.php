<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudentParent;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Atur locale ke Indonesia
        $parentCount = 60; // Jumlah parent yang akan dibuat
        $studentCount = 60; // Jumlah student yang akan dibuat
        $grades = range(1, 12); // Grade IDs
        $parentIds = [];

        // Generate Parents and Users
        for ($i = 0; $i < $parentCount; $i++) {
            $parentName = $faker->firstNameFemale . ' ' . $faker->lastName; // Nama lengkap orang tua perempuan
            $user = User::create([
                'name' => $parentName,
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password'), // Atur password yang sesuai
                'role' => 'PARENT',
            ]);

            $parentPhone = '08' . mt_rand(1000000000, 9999999999); // Nomor telepon acak

            $parent = StudentParent::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'phone' => $parentPhone,
            ]);

            $parentIds[] = $parent->id;
        }

        // Generate Students
        foreach ($parentIds as $parentId) {
            $gradeIndex = array_rand($grades); // Pilih grade secara acak untuk siswa
            $studentName = $faker->firstNameFemale . ' ' . $faker->lastName; // Nama lengkap siswa perempuan
        
            $student = Student::create([
                'grade_id' => $grades[$gradeIndex],
                'student_parent_id' => $parentId, // Gunakan ID parent yang sesuai
                'ta_student_id' => 1,
                'student_fee_id' => 1,
                'nis' => rand(100000, 999999),
                'nisn' => rand(1000000000, 9999999999),
                'nik' => rand(1000000000, 9999999999),
                'name' => $studentName,
            ]);
        }
    }
}
