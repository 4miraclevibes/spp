@extends('layouts.main')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Biodata</h5>
    </div>
    <div class="card-body">
      <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
          <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="basic-default-name" placeholder="" />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">NIS</label>
          <div class="col-sm-10">
            <input type="number" name="nis" class="form-control" id="basic-default-name" placeholder="" />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">NISN</label>
          <div class="col-sm-10">
            <input type="number" name="nisn" class="form-control" id="basic-default-name" placeholder="" />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">NIK</label>
          <div class="col-sm-10">
            <input type="number" name="nik" class="form-control" id="basic-default-name" placeholder="" />
          </div>
        </div>
        <div class="row mb-3">
          <label for="parentSelect" class="form-label col-sm-2">Jenis SPP</label>
          <div class="col-sm-10">
            <select class="form-select" name="student_fee_id" id="select1" aria-label="Default select example">
              @foreach ($studentFee as $fee)
              <option value="{{ $fee->id }}">{{ $fee->name }} - Rp. {{ number_format($fee->price, 0, ',', '.') }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label for="parentSelect" class="form-label col-sm-2">Parent</label>
          <div class="col-sm-10">
            <select class="form-select" name="student_parent_id" id="select2" aria-label="Default select example">
              @foreach ($parents as $parent)
              <option value="{{ $parent->id }}">{{ $parent->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label for="exampleFormControlSelect1" class="form-label col-sm-2">TA</label>
          <div class="col-sm-10">
            <select class="form-select" name="ta_student_id" id="exampleFormControlSelect1" aria-label="Default select example">
              @foreach ($ta as $t)
              <option value="{{ $t->id }}">{{ $t->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label for="exampleFormControlSelect1" class="form-label col-sm-2">Rombel</label>
          <div class="col-sm-10">
            <select class="form-select" name="grade_id" id="exampleFormControlSelect1" aria-label="Default select example">
              @foreach ($grades as $grade)
              <option value="{{ $grade->id }}">{{ $grade->name }}</option>
              @endforeach
            </select>
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
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('#parentSelect').select2({
      placeholder: "Pilih Parent",
      allowClear: true
    });
  });
</script>
@endpush

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush