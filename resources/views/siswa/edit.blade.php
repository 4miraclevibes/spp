@extends('layouts.main')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Biodata</h5>
    </div>
    <div class="card-body">
      <form action="{{ route('student.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
          <div class="col-sm-10">
            <input type="text" name="name" value="{{ $item->name }}" class="form-control" id="basic-default-name" placeholder="" />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">NIS</label>
          <div class="col-sm-10">
            <input type="number" name="nis" class="form-control" value="{{ $item->nis }}" id="basic-default-name" placeholder="" />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">NISN</label>
          <div class="col-sm-10">
            <input type="number" name="nisn" class="form-control" value="{{ $item->nisn }}" id="basic-default-name" placeholder="" />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">NIK</label>
          <div class="col-sm-10">
            <input type="number" name="nik" class="form-control" id="basic-default-name" value="{{ $item->nik }}" placeholder="" />
          </div>
        </div>
        <div class="row mb-3">
          <label for="exampleFormControlSelect1" class="form-label col-sm-2">Jenis SPP</label>
          <div class="col-sm-10">
            <select class="form-select" name="student_parent_id" id="select1" aria-label="Default select example">
              @foreach ($studentFee as $fee)
              <option value="{{ $fee->id }}" {{ $item->student_fee_id == $fee->id ? 'selected' : '' }}>{{ $fee->name }} - Rp. {{ number_format($fee->price, 0, ',', '.') }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label for="exampleFormControlSelect1" class="form-label col-sm-2">SPP</label>
          <div class="col-sm-10">
            <select class="form-select" name="student_parent_id" id="select2" aria-label="Default select example">
              @foreach ($parents as $parent)
              <option value="{{ $parent->id }}" {{ $item->student_parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label for="exampleFormControlSelect1" class="form-label col-sm-2">TA</label>
          <div class="col-sm-10">
            <select class="form-select" name="ta_student_id" id="exampleFormControlSelect1" aria-label="Default select example">
              <option value="{{ $item->taStudent->id }}">{{ $item->taStudent->name }}</option>
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
              <option value="{{ $item->grade->id }}">{{ $item->grade->name }}</option>
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