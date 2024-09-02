@extends('layouts.main')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">Tambah Rombel</h5>
    <form action="{{ route('grade.update', $item->id) }}" method="POST" class="p-3" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
        <div class="col-sm-10">
          <input type="text" name="name" value="{{ $item->name }}" class="form-control" id="basic-default-name" placeholder="" />
        </div>
      </div>
      <div class="row mb-3">
        <label for="parentSelect" class="form-label col-sm-2">Guru</label>
        <div class="col-sm-10">
          <select class="form-select" name="teacher_id" id="select2" aria-label="Default select example">
            @foreach ($teachers as $teacher)
            <option value="{{ $teacher->id }}">{{ $teacher->user->name }}</option>
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

  <div class="card mt-3">
    <h5 class="card-header">Table Rombel</h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Nama</th>
            <th class="text-white">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->name }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('grade.edit', $item->id) }}"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                  <a class="dropdown-item" href="{{ route('grade.destroy', $item->id) }}"><i class="bx bx-trash me-1"></i>Delete</a>
                </div>
              </div>
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