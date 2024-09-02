<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fees = Fee::all();
        return view('fees.index', compact('fees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);

        Fee::create($request->all());

        return redirect()->route('fees.index')->with('success', 'Fee created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fee $fee)
    {
        $fee->delete();

        return redirect()->route('fees.index')->with('success', 'Fee deleted successfully.');
    }
}