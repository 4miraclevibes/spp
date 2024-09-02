@extends('layouts.main')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">SPP {{ $item->student->name }}</h5>
    <form action="{{ route('spp.update', $item->id) }}" method="POST" class="p-3" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row mb-3">
        <label for="exampleFormControlSelect1" class="form-label col-sm-2">Via bayar</label>
        <div class="col-sm-10">
          <select class="form-select" name="via" id="exampleFormControlSelect1" aria-label="Default select example">
                <option value="CASH">CASH</option>
                <option value="TRANSFER">TRANSFER</option>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="exampleFormControlSelect1" class="form-label col-sm-2">Status</label>
        <div class="col-sm-10">
          <select class="form-select" name="status" id="exampleFormControlSelect1" aria-label="Default select example">
                <option value="LUNAS">LUNAS</option>
                <option value="BELUM BAYAR">BELUM BAYAR</option>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal</label>
        <div class="col-sm-10">
          <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="form-control" id="basic-default-name" placeholder="" />
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Bukti Pembayaran</label>
        <div class="col-sm-10">
          <input type="file" name="payment_proof" class="form-control" id="basic-default-name" placeholder="" />
        </div>
      </div>
      <div class="row justify-content-end">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-sm btn-dark mt-3">Kirim</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- / Content -->
@endsection