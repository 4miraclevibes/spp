@extends('layouts.main')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">Tambah Tahun Ajaran Siswa</h5>
    <form action="{{ route('ta.store') }}" method="POST" class="p-3" enctype="multipart/form-data">
      @csrf
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
        <div class="col-sm-10">
          <input type="text" name="name" class="form-control" id="basic-default-name" placeholder="" />
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
    <h5 class="card-header">Table TA</h5>
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
              <a href="{{ route('ta.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
              <form action="{{ route('ta.destroy', $item->id) }}" method="post" style="display:inline-block;">
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