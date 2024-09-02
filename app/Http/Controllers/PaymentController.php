<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('user', 'fee')->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fees = Fee::all();
        $students = Student::all();
        return view('payments.create', compact('fees', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $amount = Fee::find($request->fee_id)->amount;
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_id' => 'required|exists:fees,id',
            'status' => 'nullable|string',
        ]);


        Payment::create([
            'student_id' => $request->student_id,
            'fee_id' => $request->fee_id,
            'amount' => $amount,
            'status' => $request->status,
            'user_id' => Auth::id(), // Mengambil user_id dari pengguna yang sedang login
        ]);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $fees = Fee::all();
        $students = Student::all();
        return view('payments.edit', compact('payment', 'fees', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_id' => 'required|exists:fees,id',
            'status' => 'nullable|string',
        ]);

        $payment->update([
            'student_id' => $request->student_id,
            'fee_id' => $request->fee_id,
            'status' => $request->status,
        ]);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }

    /**
     * Display a listing of the payment details.
     */
    public function detailsIndex(Payment $payment)
    {
        $paymentDetails = PaymentDetail::with('payment')->where('payment_id', $payment->id)->get();
        return view('payments.details.index', compact('paymentDetails', 'payment'));
    }

    /**
     * Show the form for creating a new payment detail.
     */
    public function detailsCreate(Payment $payment)
    {
        return view('payments.details.create', compact('payment'));
    }

    /**
     * Store a newly created payment detail in storage.
     */
    public function detailsStore(Request $request, Payment $payment)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'payment_proof' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'status' => 'nullable|string',
        ]);

        $data = $request->only(['amount', 'status', 'payment_method']);
        $data['payment_id'] = $payment->id;

        if ($request->hasFile('payment_proof')) {
            $data['payment_proof'] = $request->file('payment_proof')->store('public/payment_proofs');
        }

        PaymentDetail::create($data);

        return redirect()->route('payments.details.index', $payment->id)->with('success', 'Detail pembayaran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified payment detail.
     */
    public function detailsEdit(PaymentDetail $paymentDetail)
    {
        $payments = Payment::all(); 
        return view('payments.details.edit', compact('paymentDetail', 'payments'));
    }

    /**
     * Update the specified payment detail in storage.
     */
    public function detailsUpdate(Request $request, PaymentDetail $paymentDetail)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'payment_proof' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'status' => 'nullable|string',
        ]);

        $data = $request->only(['amount', 'status', 'payment_method']);

        if ($request->hasFile('payment_proof')) {
            if ($paymentDetail->payment_proof) {
                Storage::delete($paymentDetail->payment_proof);
            }
            $data['payment_proof'] = $request->file('payment_proof')->store('public/payment_proofs');
        }

        $paymentDetail->update($data);

        return redirect()->route('payments.details.index', $paymentDetail->payment_id)->with('success', 'Detail pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified payment detail from storage.
     */
    public function detailsDestroy(PaymentDetail $paymentDetail)
    {
        if ($paymentDetail->payment_proof) {
            Storage::delete($paymentDetail->payment_proof);
        }

        $paymentDetail->delete();

        return redirect()->route('payments.details.index', $paymentDetail->payment_id)->with('success', 'Detail pembayaran berhasil dihapus.');
    }
}