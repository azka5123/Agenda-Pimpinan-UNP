@extends('admin.layout.app')

@section('title', 'User')

@section('main_content')
    <h1 class="h3 mb-2 text-gray-800">User</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{ route('admin_user_create') }}" class="btn btn-info">
                    <i class="fas fa-plus"></i>Add User</a></h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($user as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->email }}</td>
                                <td><a href="{{ route('admin_user_edit', $item->id) }}" class="btn btn-warning"> <i
                                            class="fas fa-edit"></i>edit</a>
                                    <a href="{{ route('admin_user_delete', $item->id) }}" class="btn btn-danger"
                                        onclick="return confirm('are u sure?')"> <i class="fas fa-trash"></i>delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
