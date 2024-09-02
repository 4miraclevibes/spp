@extends('layouts.main')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">Tambah Master Nominal</h5>
    <form action="{{ route('spp/student.store') }}" method="POST" class="p-3" enctype="multipart/form-data">
      @csrf
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Label</label>
        <div class="col-sm-10">
          <input type="text" name="name" class="form-control" id="basic-default-name" placeholder="" />
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Tarif Master Nominal</label>
        <div class="col-sm-10">
          <input type="number" name="price" class="form-control" id="basic-default-name" placeholder="" />
        </div>
      </div>
      <div class="row justify-content-end">
        <div class="col-sm-10">
          <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengirim data ini?')" class="btn btn-sm btn-dark mt-3">Simpan</button>
        </div>
      </div>
    </form>
  </div>

  <div class="card mt-3">
    <h5 class="card-header">Table Master Nominal</h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Created At</th>
            <th class="text-white">Label</th>
            <th class="text-white">Tarif</th>
            <th class="text-white">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ date_format($item->created_at, 'd - F - Y | H:i:s') }}</td>
            <td>{{ $item->name }}</td>
            <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
            <td>
              <a href="{{ route('spp/student.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="bx bx-edit me-1"></i>Edit</a>
              <form action="{{ route('spp/student.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" style="display: inline-block">
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