<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        // Mengambil pengguna dengan peran 'TEACHER' yang belum memiliki relasi teacher
        $users = User::where('role', 'TEACHER')->doesntHave('teacher')->get();
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers', 'users'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $data = $request->only('user_id', 'phone', 'address');
        Teacher::create($data);
        return redirect()->route('teacher.index')->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $teacher = Teacher::find($id);
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required',
            'address' => 'required',
        ]);

        $data = $request->only('phone', 'address');
        Teacher::find($id)->update($data);
        return redirect()->route('teacher.index')->with('success', 'Guru berhasil diubah');
    }

    public function destroy($id)
    {
        Teacher::find($id)->delete();
        return redirect()->route('teacher.index')->with('success', 'Guru berhasil dihapus');
    }
}