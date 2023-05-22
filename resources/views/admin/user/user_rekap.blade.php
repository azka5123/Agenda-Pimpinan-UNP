@extends('admin.layout.app')

@section('title', 'rekap')

@section('main_content')
    <h1 class="h3 mb-2 text-gray-800">rekap</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{ route('admin_user_export', $user->id) }}"
                    class="btn btn-info">
                    <i class="fas fa-plus"></i> Export to excel</a></h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <td colspan="5" rowspan="2" align="center"><b>Rekap Jadwal {{ $user->nama }}</b></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>

                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
                        <th>Waktu mulai</th>
                        <th>Waktu berakhir</th>
                    </tr>

                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Waktu mulai</th>
                            <th>Waktu berakhir</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($jadwal as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->rUser->nama }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ $item->start_time }}</td>
                                <td>{{ $item->finish_time }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
