@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">Edit Detail Pembayaran</h5>
    <form action="{{ route('payments.details.update', $paymentDetail->id) }}" method="POST" class="p-3" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="payment_id">Payment ID</label>
        <div class="col-sm-10">
          <select name="payment_id" class="form-select" id="payment_id">
            @foreach ($payments as $payment)
            <option value="{{ $payment->id }}" {{ $paymentDetail->payment_id == $payment->id ? 'selected' : '' }}>{{ $payment->id }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="amount">Jumlah Pembayaran</label>
        <div class="col-sm-10">
          <input type="number" name="amount" class="form-control" id="amount" value="{{ $paymentDetail->amount }}" placeholder="Masukkan jumlah pembayaran" />
        </div>
      </div>
      @if (Auth::user()->role == 'ADMIN')
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="status">Status</label>
        <div class="col-sm-10">
          <select name="status" class="form-select" id="status">
            <option value="pending" {{ $paymentDetail->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="paid" {{ $paymentDetail->status == 'paid' ? 'selected' : '' }}>Paid</option>
          </select>
        </div>
      </div>
      @endif
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="payment_method">Metode Pembayaran</label>
        <div class="col-sm-10">
          <select name="payment_method" class="form-select" id="payment_method">
            <option value="Transfer Bank" {{ $paymentDetail->payment_method == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
            <option value="Tunai" {{ $paymentDetail->payment_method == 'Tunai' ? 'selected' : '' }}>Tunai</option>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="payment_proof">Bukti Pembayaran</label>
        <div class="col-sm-10">
          <input type="file" name="payment_proof" class="form-control" id="payment_proof" />
          @if ($paymentDetail->payment_proof)
          <a href="{{ Storage::url($paymentDetail->payment_proof) }}" target="_blank">Lihat Bukti</a>
          @endif
        </div>
      </div>
      <div class="row justify-content-end">
        <div class="col-sm-10">
          <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengirim data ini?')" class="btn btn-sm btn-dark mt-3">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- / Content -->
@endsection