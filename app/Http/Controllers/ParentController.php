<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentParent;
use App\Models\User;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = StudentParent::all();
        return view('parent.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = User::where('role', 'PARENT')->with('studentParent')->get();
        return view('parent.create', [
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        StudentParent::create($data);
        return redirect()->route('parent.index')->with('success', 'SUKSES');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = StudentParent::find($id);
        return view('parent.show', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::where('role', 'PARENT')->with('studentParent')->get();
        $item = StudentParent::find($id);
        return view('parent.edit', [
            'item' => $item,
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = StudentParent::find($id);
        $data = $request->all();
        $item->update($data);
        return redirect()->route('parent.index')->with('success', 'SUKSES');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = StudentParent::find($id);
        $item->delete();
        return back()->with('success', 'SUKSESS');
    }
}
