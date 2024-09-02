@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">Edit Pembayaran</h5>
    <form action="{{ route('payments.update', $payment->id) }}" method="POST" class="p-3" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="student_id">Nama Siswa</label>
        <div class="col-sm-10">
          <select name="student_id" class="form-select" id="student_id">
            @foreach ($students as $student)
            <option value="{{ $student->id }}" {{ $payment->student_id == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="fee_id">Jenis Biaya</label>
        <div class="col-sm-10">
          <select name="fee_id" class="form-select" id="fee_id">
            @foreach ($fees as $fee)
            <option value="{{ $fee->id }}" {{ $payment->fee_id == $fee->id ? 'selected' : '' }}>{{ $fee->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      @if (Auth::user()->role == 'ADMIN')
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="status">Status</label>
        <div class="col-sm-10">
          <select name="status" class="form-select" id="status">
            <option value="Pending" {{ $payment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Completed" {{ $payment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
          </select>
        </div>
      </div>
      @endif
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