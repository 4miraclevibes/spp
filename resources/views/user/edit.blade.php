@extends('layouts.main')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Biodata</h5>
    </div>
    <div class="card-body">
      <form action="{{ route('user.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
          <div class="col-sm-10">
            <input type="text" name="name" value="{{ $item->name }}" class="form-control" id="basic-default-name" placeholder="" />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">Email</label>
          <div class="col-sm-10">
            <input type="email" name="email" value="{{ $item->email }}" class="form-control" id="basic-default-name" placeholder="" />
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">Password</label>
          <div class="col-sm-10">
            <input type="password" name="password" class="form-control" id="basic-default-name" placeholder="" />
          </div>
        </div>
        <div class="row mb-3">
          <label for="exampleFormControlSelect1" class="form-label col-sm-2">Role</label>
          <div class="col-sm-10">
            <select class="form-select" name="role" id="exampleFormControlSelect1" aria-label="Default select example">
              <option selected value="{{ $item->role }}">{{ $item->role }}</option>
              <option value="ADMIN" {{ $item->role == 'ADMIN' ? 'selected' : '' }}>ADMIN</option>
              <option value="PARENT" {{ $item->role == 'PARENT' ? 'selected' : '' }}>PARENT</option>
              <option value="TEACHER" {{ $item->role == 'TEACHER' ? 'selected' : '' }}>TEACHER</option>
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