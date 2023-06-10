@extends('user.layout.app')

@section('heading', 'Jadwal Edit')

@section('main_content')
    <div class="section-body">
        <form action="{{ route('update_jadwal', $edit->id) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h5>Edit Jadwal</h5>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="tanggal" value="{{ Auth::user()->nama }}"
                                    readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label>Nama Kegiatan</label>
                                <input type="text" class="form-control" name="title" value="{{ $edit->title }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Tanggal Mulai</label>
                                <input type="datetime-local" class="form-control" name="start_time"
                                    value="{{ $edit->start_time }}" id="date1">
                            </div>
                            <div class="form-group mb-3">
                                <label>Tanggal Berakhir</label>
                                <input type="datetime-local" class="form-control" name="finish_time"
                                    value="{{ $edit->finish_time }}" id="date2">
                            </div>
                            <div class="form-group mb-3">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan" rows="5" value="">{{ $edit->keterangan }}</textarea>

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
