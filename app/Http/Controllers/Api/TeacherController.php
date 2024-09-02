<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(){
        $teachers = Teacher::with('user', 'grade')->get();
        return response()->json([
            'data' => $teachers,
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'data berhasil di ambil'
            ],
        ], 200);
    }
}
