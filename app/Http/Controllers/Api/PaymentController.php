<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Fee;
use App\Models\PaymentDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 'ADMIN'){
            $payments = Payment::with('user', 'fee', 'paymentDetails')->get();
        }else{
            $payments = Payment::with('user', 'fee', 'paymentDetails')->where('user_id', Auth::id())->get();
        }
        return response()->json($payments, 200);
    }

    public function create()
    {
        $fees = Fee::all();
        return response()->json($fees, 200);
    }

    public function store(Request $request)
    {
        $amount = Fee::find($request->fee_id)->amount;
        $request->validate([
            'student_name' => 'required|string|max:255',
            'student_nik' => 'required|string|max:255',
            'fee_id' => 'required|exists:fees,id',
            'status' => 'nullable|string',
        ]);

        $payment = Payment::create([
            'student_name' => $request->student_name,
            'student_nik' => $request->student_nik,
            'fee_id' => $request->fee_id,
            'status' => $request->status,
            'amount' => $amount,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['success' => 'Pembayaran berhasil ditambahkan.', 'payment' => $payment], 201);
    }

    public function edit(Payment $payment)
    {
        $fees = Fee::all();
        return response()->json(['payment' => $payment, 'fees' => $fees], 200);
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'student_nik' => 'required|string|max:255',
            'fee_id' => 'required|exists:fees,id',
            'status' => 'nullable|string',
        ]);

        $payment->update([
            'student_name' => $request->student_name,
            'student_nik' => $request->student_nik,
            'fee_id' => $request->fee_id,
            'status' => $request->status,
        ]);

        return response()->json(['success' => 'Pembayaran berhasil diperbarui.', 'payment' => $payment], 200);
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(['success' => 'Pembayaran berhasil dihapus.'], 200);
    }

    public function detailsIndex(Payment $payment)
    {
        $paymentDetails = PaymentDetail::with('payment')->where('payment_id', $payment->id)->get();
        return response()->json(['paymentDetails' => $paymentDetails], 200);
    }

    public function detailsCreate(Payment $payment)
    {
        return response()->json($payment, 200);
    }

    public function detailsStore(Request $request, Payment $payment)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'status' => 'nullable|string',
            'payment_proof' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);

        $data = $request->only(['amount', 'status', 'payment_method']);
        $data['payment_id'] = $payment->id;

        if ($request->hasFile('payment_proof')) {
            $data['payment_proof'] = $request->file('payment_proof')->store('public/payment_proofs');
        }

        $paymentDetail = PaymentDetail::create($data);

        return response()->json(['success' => 'Detail pembayaran berhasil ditambahkan.', 'paymentDetail' => $paymentDetail], 201);
    }

    public function detailsEdit(PaymentDetail $paymentDetail)
    {
        $paymentDetail = PaymentDetail::find($paymentDetail);
        return response()->json($paymentDetail, 200);
    }

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

        return response()->json(['success' => 'Detail pembayaran berhasil diperbarui.', 'paymentDetail' => $paymentDetail], 200);
    }

    public function detailsDestroy(PaymentDetail $paymentDetail)
    {
        if ($paymentDetail->payment_proof) {
            Storage::delete($paymentDetail->payment_proof);
        }

        $paymentDetail->delete();

        return response()->json(['success' => 'Detail pembayaran berhasil dihapus.'], 200);
    }
}