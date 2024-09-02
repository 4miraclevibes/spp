@extends('layouts.main')

@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">Tambah Master Keuangan</h5>
    <form action="{{ route('fees.store') }}" method="POST" class="p-3" enctype="multipart/form-data">
      @csrf
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Jenis Fee</label>
        <div class="col-sm-10">
          <select name="name" class="form-select" id="basic-default-name">
            <option value="UANG PANGKAL">UANG PANGKAL</option>
            <option value="DAFTAR ULANG">DAFTAR ULANG</option>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-amount">Jumlah Fee</label>
        <div class="col-sm-10">
          <input type="number" name="amount" class="form-control" id="basic-default-amount" placeholder="Masukkan jumlah Fee" />
        </div>
      </div>
      <div class="row justify-content-end">
        <div class="col-sm-10">
          <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengirim data ini?')" class="btn btn-sm btn-dark mt-3">Kirim</button>
        </div>
      </div>
    </form>
  </div>

  <div class="card mt-3">
    <h5 class="card-header">Table Master Keuangan</h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Jenis Fee</th>
            <th class="text-white">Jumlah Fee</th>
            <th class="text-white">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($fees as $fee)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $fee->name }}</td>
            <td>Rp. {{ number_format($fee->amount, 0, ',', '.') }}</td>
            <td>
              <form action="{{ route('fees.destroy', $fee->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" style="display: inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"><i class="bx bx-trash me-1"></i>Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- / Content -->
@endsection