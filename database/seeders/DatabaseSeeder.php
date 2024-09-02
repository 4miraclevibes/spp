<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menghapus semua file dalam storage
        $this->deleteAllFiles();

        // Refresh migration
        Artisan::call('migrate:fresh');

        // Menjalankan seeder
        $this->call([
            UserSeeder::class,
            TeacherSeeder::class,
            GradeSeeder::class,
            StudentFeeSeeder::class,
            TaSeeder::class,
            ParentSeeder::class,
        ]);
    }

    /**
     * Menghapus semua file dalam storage.
     */
    public function deleteAllFiles()
    {
        // Mengambil semua file dalam storage
        $files = Storage::allFiles();
        
        // Menghapus semua file
        foreach ($files as $file) {
            Storage::delete($file);
        }

        // Memeriksa apakah semua file berhasil dihapus
        if (empty(Storage::allFiles())) {
            echo "Semua file dalam storage berhasil dihapus.\n";
        } else {
            echo "Gagal menghapus file dalam storage.\n";
        }
    }
}
