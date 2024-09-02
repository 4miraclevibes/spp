<?php

namespace App\Http\Controllers;

use App\Models\SppStudent;
use App\Models\Student;
use App\Models\StudentFee;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class StudentFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = StudentFee::all();
        // dd($data);
        return view('masterSpp.index',[
            'data' => $data
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
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        $data = $request->only('name', 'price');
        StudentFee::create($data);
        return redirect()->route('spp/student.index')->with('success', 'SUKSES');
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
        $studentFee = StudentFee::find($id);
        $data = StudentFee::all();
        return view('masterSpp.edit',[
            'feeStudent' => $studentFee,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        $data = $request->only('name', 'price');
        StudentFee::find($id)->update($data);
        return redirect()->route('spp/student.index')->with('success', 'SUKSES');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $studentFee = StudentFee::find($id);
        if($studentFee->students->count() > 0){
            return redirect()->route('spp/student.index')->with('error', 'GAGAL');
        } else {
            $studentFee->delete();
            return redirect()->route('spp/student.index')->with('success', 'SUKSES');
        }
    }
}
