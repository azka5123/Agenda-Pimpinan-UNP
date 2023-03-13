@extends('admin.layout.app')

@section('heading', 'User Create')

@section('main_content')
    <div class="section-body">
        <form action="{{ route('admin_user_store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h5>Create User</h5>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama">
                            </div>
                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group mb-3">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" name="jabatan">
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
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
