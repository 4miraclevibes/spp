@extends('layouts.main')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  @if (Auth::user()->role !== 'ADMIN')
  <div class="card mt-3">
    <h5 class="card-header">Table SPP</h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">ID</th>
            <th class="text-white">Nama Siswa</th>
            <th class="text-white">Nama Wali</th>
            <th class="text-white">Email Wali</th>
            <th class="text-white">Rombel Siswa</th>
            <th class="text-white">Tagihan</th>
            <th class="text-white">Bulan</th>
            <th class="text-white">Status</th>
            <th class="text-white">Bukti TF</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($fees as $fee)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $fee->id }}</td>
            <td>{{ $fee->student->name }}</td>
            <td>{{ $fee->student->studentParent->name }}</td>
            <td>{{ $fee->student->studentParent->user->email }}</td>
            <td>{{ $fee->student->grade->name }}</td>
            <td>{{ number_format($fee->price, 0, ',', '.') }}</td>
            <td>{{ $fee->bulan }}</td>
            <td>{{ $fee->status }}</td>
            @if ($fee->status == 'BELUM BAYAR' && Auth::user()->role !== 'ADMIN')
            <td>
              <form action="{{ route('transaction.store', $fee->id) }}" enctype="multipart/form-data" method="POST" style="min-width: max-content;">
                @csrf
                <div class="row">
                  <div class="mb-3 col-7">
                    <input class="form-control form-control-sm mt-3" name="image" id="formFileSm" type="file">
                  </div>
                  <button class="btn btn-sm btn-success col-2 my-auto" type="submit">Submit</button>
                </div>
              </form>
            </td>
            @elseif($fee->status == 'LUNAS' && Auth::user()->role !== 'ADMIN')
            <td>DONE</td>
            @else
            <td><a href="#" class="btn btn-primary btn-sm">Bukti pembayaran</a></td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endif
  <div class="card mt-3">
    <h5 class="card-header">Table Transaction</h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example1">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">User</th>
            <th class="text-white">Nama Siswa</th>
            <th class="text-white">Nama Wali</th>
            <th class="text-white">Email Wali</th>
            <th class="text-white">Rombel Siswa</th>
            <th class="text-white">Tagihan</th>
            <th class="text-white">Bulan</th>
            <th class="text-white">Status</th>
            <th class="text-white">Bukti TF</th>
            @if (Auth::user()->role == 'ADMIN')
            <th class="text-white">Action</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->sppStudent->student->name }}</td>
            <td>{{ $item->sppStudent->student->studentParent->name }}</td>
            <td>{{ $item->sppStudent->student->studentParent->user->email }}</td>
            <td>{{ $item->sppStudent->student->grade->name }}</td>
            <td>{{ number_format($item->sppStudent->price, 0, ',', '.') }}</td>
            <td>{{ $item->sppStudent->bulan }}</td>
            <td>{{ $item->status }}</td>
            <td><a href="{{ Storage::url($item->image) }}" target="_blank" class="btn btn-sm btn-primary">Klik</a></td>
            @if (Auth::user()->role == 'ADMIN')
            <td>
              @if ($item->status == 'PENDING')
              <a href="{{ route('transaction.terima', $item->id) }}" class="btn btn-sm btn-success">Terima</a>
              <a href="{{ route('transaction.tolak', $item->id) }}" class="btn btn-sm btn-danger">Tolak</a>
              @elseif ($item->status == 'SUKSES')
              <a href="{{ route('transaction.tolak', $item->id) }}" class="btn btn-sm btn-danger disabled">Tolak</a>
              @elseif ($item->status == 'DITOLAK')
              <a href="{{ route('transaction.terima', $item->id) }}" class="btn btn-sm btn-success">Terima</a>
              @endif
            </td>
            @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- / Content -->
@endsection