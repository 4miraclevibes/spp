@extends('layouts.main')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">Semua data wali murid <a href="{{ route('parent.create') }}" class="btn btn-sm btn-success">Tambah</a></h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Nama</th>
            <th class="text-white">Phone</th>
            <th class="text-white">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ $item->phone }}</td>
            <td>
              <a href="{{ route('parent.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
              <a href="{{ route('parent.show', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
              <form action="{{ route('parent.destroy', $item->id) }}" method="post" style="display:inline-block;">
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