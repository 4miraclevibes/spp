@extends('layouts.main')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card mt-3">
    <h5 class="card-header">Laporan</h5>
    <div class="card-body">
      <form id="filterForm" method="GET" action="{{ route('report.index') }}">
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="filterBulan" class="form-label">Bulan</label>
            <select class="form-select" name="bulan" id="filterBulan">
              <option value="">Pilih Bulan</option>
              @foreach ($months as $month)
              <option value="{{ $month }}" {{ request('bulan') == $month ? 'selected' : '' }}>{{ $month }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label for="filterTahun" class="form-label">Tahun</label>
            <select class="form-select" name="tahun" id="filterTahun">
              <option value="">Pilih Tahun</option>
              @foreach ($years as $year)
              <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label for="filterGrade" class="form-label">Grade</label>
            <select class="form-select" name="grade" id="filterGrade">
              <option value="">Pilih Grade</option>
              @foreach ($grades as $grade)
              <option value="{{ $grade->id }}" {{ request('grade') == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Filter</button>
      </form>
    </div>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Nama Siswa</th>
            <th class="text-white">NIS</th>
            <th class="text-white">Rombel</th>
            <th class="text-white">Nama Wali</th>
            <th class="text-white">Bulan Tagihan</th>
            <th class="text-white">Tanggal Bayar</th>
            <th class="text-white">Via Bayar</th>
            <th class="text-white">Status</th>
            <th class="text-white">Tahun</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->student->name }}</td>
            <td>{{ $item->student->nis }}</td>
            <td>{{ $item->student->grade->name }}</td>
            <td>{{ $item->student->studentParent->name }}</td>
            <td>{{ $item->bulan }}</td>
            <td>{{ $item->tanggal ?? 'BELUM BAYAR' }}</td>
            <td>{{ $item->via ?? 'BELUM BAYAR' }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->tahun }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- / Content -->
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('#filterBulan, #filterTahun, #filterGrade').select2({
      placeholder: "Pilih",
      allowClear: true
    });
  });
</script>
@endpush

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush