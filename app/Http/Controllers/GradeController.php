<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with('user')->get();
        $data = Grade::all();
        return view('grade.index', [
            'data' => $data,
            'teachers' => $teachers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Grade::create([
            'name' => $request->name,
        ]);
        return back()->with('success', 'SUKSESS');
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
        $item = Grade::find($id);
        $data = Grade::all();
        $teachers = Teacher::with('user')->get();
        return view('grade.edit', [
            'item' => $item,
            'data' => $data,
            'teachers' => $teachers
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Grade::find($id);
        $item->update([
            'name' => $request->name,
        ]);
        return redirect()->route('grade.index')->with('success', 'SUKSES');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Grade::find($id);
        $item->delete();
        return redirect()->route('grade.index')->with('success', 'SUKSESS');
    }
}
