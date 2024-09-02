@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">Tambah Pembayaran</h5>
    <form action="{{ route('payments.store') }}" method="POST" class="p-3" enctype="multipart/form-data">
      @csrf
      <div class="row mb-3">
        <label for="parentSelect" class="form-label col-sm-2">Student</label>
        <div class="col-sm-10">
          <select class="form-select" name="student_id" id="select2" aria-label="Default select example">
            @foreach ($students as $student)
            <option value="{{ $student->id }}">{{ $student->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="fee_id">Jenis Biaya</label>
        <div class="col-sm-10">
          <select name="fee_id" class="form-select" id="fee_id">
            @foreach ($fees as $fee)
            <option value="{{ $fee->id }}">{{ $fee->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      @if (Auth::user()->role == 'ADMIN')
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="status">Status</label>
        <div class="col-sm-10">
          <select name="status" class="form-select" id="status">
            <option value="pending">Pending</option>
            <option value="paid">Paid</option>
            <option value="ongoing">Ongoing</option>
          </select>
        </div>
      </div>
      @endif
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