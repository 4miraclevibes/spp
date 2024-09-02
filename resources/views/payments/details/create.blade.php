@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">Tambah Detail Pembayaran</h5>
    <form action="{{ route('payments.details.store', $payment->id) }}" method="POST" class="p-3" enctype="multipart/form-data">
      @csrf
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="amount">Jumlah Pembayaran</label>
        <div class="col-sm-10">
          <input type="number" name="amount" class="form-control" id="amount" placeholder="Masukkan jumlah pembayaran" />
        </div>
      </div>
      @if (Auth::user()->role == 'ADMIN')
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="status">Status</label>
        <div class="col-sm-10">
          <select name="status" class="form-select" id="status">
            <option value="pending">Pending</option>
            <option value="paid">Paid</option>
          </select>
        </div>
      </div>
      @endif
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="payment_method">Metode Pembayaran</label>
        <div class="col-sm-10">
          <select name="payment_method" class="form-select" id="payment_method">
            <option value="Transfer Bank">Transfer Bank</option>
            <option value="Tunai">Tunai</option>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="payment_proof">Bukti Pembayaran</label>
        <div class="col-sm-10">
          <input type="file" name="payment_proof" class="form-control" id="payment_proof" />
        </div>
      </div>
      <div class="row justify-content-end">
        <div class="col-sm-10">
          <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengirim data ini?')" class="btn btn-sm btn-dark mt-3">Kirim</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- / Content -->
@endsection