@extends('user.layout.app')

@section('heading', 'Jadwal Create')

@section('main_content')
    <div class="section-body">
        <form action="{{ route('store_jadwal') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h5>Create Jadwal</h5>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Id Dosen</label>
                                <select name="user_id" class="form-control">
                                    <option value="">-Pilih-</option>
                                    @foreach ($dosen as $item)
                                         <option value="{{ $item->id }}">{{ $item->id }}. {{ $item->nama }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Tanggal Mulai</label>
                                <input type="datetime-local" class="form-control" name="start_time">
                            </div>
                            <div class="form-group mb-3">
                                <label>Tanggal Berakhir</label>
                                <input type="datetime-local" class="form-control" name="finish_time">
                            </div>
                            <div class="form-group mb-3">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan" rows="5"></textarea>
                                
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
