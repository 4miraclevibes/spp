<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // Menghitung total kelas dan siswa
        $totalClasses = Grade::count();
        $totalStudents = Student::count();

        // Data untuk chart
        $years = range(date('Y') - 5, date('Y') + 5);
        $studentCounts = $this->getStudentCountsByYear($years);

        return view('dashboard', compact('totalClasses', 'totalStudents', 'years', 'studentCounts'));
    }

    /**
     * Get student counts by year.
     */
    private function getStudentCountsByYear($years)
    {
        // Menyesuaikan query berdasarkan jenis database
        if (config('database.default') === 'pgsql') {
            $studentCounts = Student::selectRaw('EXTRACT(YEAR FROM created_at) as year, COUNT(*) as count')
                ->whereIn(DB::raw('EXTRACT(YEAR FROM created_at)'), $years)
                ->groupBy('year')
                ->orderBy('year')
                ->pluck('count', 'year')
                ->toArray();
        } else {
            $studentCounts = Student::selectRaw('DATE_FORMAT(created_at, \'%Y\') as year, COUNT(*) as count')
                ->whereIn(DB::raw('DATE_FORMAT(created_at, \'%Y\')'), $years)
                ->groupBy('year')
                ->orderBy('year')
                ->pluck('count', 'year')
                ->toArray();
        }

        // Mengisi tahun yang tidak ada dengan nilai 0
        $studentCounts = array_replace(array_fill_keys($years, 0), $studentCounts);

        return array_values($studentCounts);
    }
}