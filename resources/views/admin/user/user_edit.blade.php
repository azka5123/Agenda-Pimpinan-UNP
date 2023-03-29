@extends('admin.layout.app')

@section('heading', 'User Edit')

@section('main_content')
    <div class="section-body">
        <form action="{{ route('admin_user_update', $edit->id) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h5>Edit User</h5>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" value="{{ $edit->nama }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $edit->email }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" value="{{ $edit->jabatan }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group mb-3">
                                <label>Retype Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
