<?php

namespace App\Http\Controllers;

use App\Models\SppStudent;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Data untuk filter
        $months = ['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'];
        $years = range(date('Y') - 2, date('Y'));
        $grades = Grade::all();

        // Mengambil data laporan dengan filter
        $data = SppStudent::with(['student', 'student.grade'])
                          ->when($request->bulan, function ($query, $bulan) {
                              return $query->where('bulan', strtoupper($bulan));
                          })
                          ->when($request->tahun, function ($query, $tahun) {
                              return $query->where('tahun', $tahun);
                          })
                          ->when($request->grade, function ($query, $grade) {
                              return $query->where('grade_id', $grade);
                          })
                          ->get();

        return view('report.index', compact('months', 'years', 'grades', 'data'));
    }

    public function laporanKeuangan()
    {
        $students = Student::with(['grade'])->get();
        return view('report', compact('students'));
    }
}