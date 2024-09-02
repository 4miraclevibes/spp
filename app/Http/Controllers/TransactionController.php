<?php

namespace App\Http\Controllers;

use App\Models\SppStudent;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role == 'PARENT'){
            $students = Student::where('student_parent_id', Auth::user()->studentParent->id)->pluck('id'); // Mengambil hanya id siswa
            $fees = SppStudent::whereIn('student_id', $students)->get(); // Mengambil SppStudent hanya untuk siswa yang terkait dengan user PARENT
        } else if(Auth::user()->role == 'TEACHER'){
            $teacher = Teacher::find(Auth::user()->teacher->id);
            $students = $teacher->grade->students;
            $fees = SppStudent::whereIn('student_id', $students->pluck('id'))->get();
            // dd($fees);
        } else {
            $fees = SppStudent::all(); // Mengambil semua SppStudent jika user bukan PARENT
        }
        $data = Transaction::all(); // Mengambil semua data Transaction
        
        return view('transaction.index', [
            'data' => $data,
            'fees' => $fees,
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
    public function store(Request $request, $id)
    {
        $data = $request->all();
        $data['spp_student_id'] = $id;
        $data['user_id'] = Auth::user()->id;
        if($request->file('image')){
            $data['image'] = $request->file('image')->store('assets/image', 'public');
        }
        Transaction::create($data);
        return back()->with('success', 'SUKSES');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function terima(Request $request, string $id)
    {
        $sekarang = date('Y-m-d');
        $item = Transaction::find($id);
        $spp = SppStudent::find($item->sppStudent->id);
        $item->update([
            'status' => 'SUKSES',
        ]);
        $spp->update([
            'status' => 'LUNAS',
            'via' => 'TRANSFER',
            'tanggal' => $sekarang,
        ]);
        return back()->with('success', 'SUKSESS');        
    }

    public function tolak(Request $request, string $id)
    {
        $item = Transaction::find($id);
        $spp = SppStudent::find($item->sppStudent->id);
        $item->update([
            'status' => 'DITOLAK',
        ]);
        $spp->update([
            'status' => 'BELUM BAYAR',
            'via' => null,
            'tanggal' => null,
        ]);
        return back()->with('success', 'SUKSESS');        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
