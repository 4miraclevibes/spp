<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentFee;
use App\Models\StudentParent;
use App\Models\TaStudent;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Student::with(['studentParent', 'grade', 'taStudent'])->get();
        // dd($data);
        return view('siswa.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = StudentParent::orderBy('name', 'asc')->get();
        $grades = Grade::all();
        $ta = TaStudent::all();
        $studentFee = StudentFee::all();
        return view('siswa.create', [
            'parents' => $parents,
            'grades' => $grades,
            'ta' => $ta,
            'studentFee' => $studentFee,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Student::create($data);
        return redirect()->route('student.index')->with('success', 'SUKSES');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Student::find($id);
        $parents = StudentParent::all();
        $grades = Grade::all();
        $ta = TaStudent::all();
        $studentFee = StudentFee::all();
        return view('siswa.edit', [
            'item' => $item,
            'parents' => $parents,
            'grades' => $grades,
            'ta' => $ta,
            'studentFee' => $studentFee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Student::find($id);
        $data = $request->all();
        $item->update($data);
        return redirect()->route('student.index')->with('success' , 'SUKSES');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Student::find($id);
        $item->delete();
        return redirect()->route('student.index')->with('success', 'SUKSES');
    }
}
