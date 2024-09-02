@extends('layouts.main')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">Tambah SPP</h5>
    <form action="{{ route('spp.store') }}" method="POST" class="p-3" enctype="multipart/form-data">
      @csrf
      <div class="row mb-3">
        <label for="exampleFormControlSelect1" class="form-label col-sm-2">Bulan</label>
        <div class="col-sm-10">
          <select class="form-select" name="bulan" id="exampleFormControlSelect1" aria-label="Default select example">
            @foreach ($bulans as $bulan)
                <option value="{{ $bulan }}">{{ $bulan }}</option>
            @endforeach    
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Tahun</label>
        <div class="col-sm-10">
          <input type="number" name="tahun" value="{{ date('Y') }}" class="form-control" id="basic-default-name" placeholder="" />
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
    <h5 class="card-header">Table SPP</h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Petugas</th>
            <th class="text-white">Nama Siswa</th>
            <th class="text-white">Rombel</th>
            <th class="text-white">Jenis SPP</th>
            <th class="text-white">Bukti Pembayaran</th>
            <th class="text-white">NIS</th>
            <th class="text-white">Nama Wali</th>
            <th class="text-white">Bulan Tagihan</th>
            <th class="text-white">Tanggal Bayar</th>
            <th class="text-white">Via Bayar</th>
            <th class="text-white">Status</th>
            <th class="text-white">Tahun</th>
            <th class="text-white">Tahun Ajaran</th>
            <th class="text-white">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->student->name }}</td>
            <td>{{ $item->student->grade->name }}</td>
            <td>{{ $item->student->studentFee->name }} - Rp. {{ number_format($item->student->studentFee->price, 0, ',', '.') }}</td>
            <td><a href="{{ Storage::url($item->payment_proof) }}" class="btn btn-sm btn-primary {{ $item->payment_proof ? '' : 'disabled' }}" target="_blank">Lihat Bukti</a></td>
            <td>{{ $item->student->nis }}</td>
            <td>{{ $item->student->studentParent->name }}</td>
            <td>{{ $item->bulan }}</td>
            <td>{{ $item->tanggal ?? 'BELUM BAYAR' }}</td>
            <td>{{ $item->via ?? 'BELUM BAYAR' }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->tahun }}</td>
            <td>{{ $item->tahun_ajaran }}</td>
            <td>
              <a href="{{ route('spp.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="bx bx-edit-alt me-1"></i>Edit</a>
              @if ($item->status == 'LUNAS')
                <a href="{{ route('spp.show', $item->id) }}" class="btn btn-sm btn-info" target="_blank"><i class="bx bx-show me-1"></i>Kuitansi</a>
              @endif
              <form action="{{ route('spp.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" style="display: inline-block">
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