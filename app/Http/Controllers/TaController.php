<?php

namespace App\Http\Controllers;

use App\Models\TaStudent;
use Illuminate\Http\Request;

class TaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TaStudent::all();
        return view('ta.index', [
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
        $data = $request->all();
        TaStudent::create($data);
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
        $item = TaStudent::find($id);
        $data = TaStudent::all();
        return view('ta.edit', [
            'data' => $data,
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = TaStudent::find($id);
        $item->update([
            'name' => $request->name,
        ]);
        return redirect()->route('ta.index')->with('success', 'SUKSES');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = TaStudent::find($id);
        $item->delete();
        return redirect()->route('ta.index')->with('success', 'SUKSES');
    }
}
