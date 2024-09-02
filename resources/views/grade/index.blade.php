@extends('layouts.main')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">Tambah Rombel</h5>
    <form action="{{ route('grade.store') }}" method="POST" class="p-3" enctype="multipart/form-data">
      @csrf
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
        <div class="col-sm-10">
          <input type="text" name="name" class="form-control" id="basic-default-name" placeholder="" />
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
            <th class="text-white">Guru</th>
            <th class="text-white">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ $item->teacher->user->name }}</td>
            <td>
              <a href="{{ route('grade.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
              <form action="{{ route('grade.destroy', $item->id) }}" method="post" style="display:inline-block;">
                @csrf
                @method('delete')
                <button type="submit" onclick="confirm('Are you sure you want to delete this item?')" class="btn btn-sm btn-danger">Delete</button>
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