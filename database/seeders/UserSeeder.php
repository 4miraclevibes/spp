<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            'teacher1',
            'teacher2',
            'teacher3',
            'teacher4',
            'teacher5',
            'teacher6',
            'teacher7',
            'teacher8',
            'teacher9',
            'teacher10',
            'teacher11',
            'teacher12',
        ];

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'role' => 'ADMIN',
                'password' => Hash::make('password'),
            ],
        ]);

        foreach ($teachers as $teacher) {
            DB::table('users')->insert([
                'name' => $teacher,
                'email' => $teacher.'@example.com',
                'role' => 'TEACHER',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
