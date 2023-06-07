{{-- @include('user.jadwal.show_jadwal') --}}

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="{{ asset('dist-front/css/popover.css') }}">
</head>
<body>
<div>
    @extends('user.jadwal.show_jadwal')

</div>
  <form action="{{ route('update_popover', $edit->id) }}" method="post"> 
    @csrf
      <div class="overlay"></div>
      <div class="overlayed">
        <div class="modal-header bg-info">
            <h5 class="title">Detail Event</h5>
            <a href="{{ route('show_jadwal') }}"><button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
              &times;
            </button></a>
          </div>
        <div class="overlayed-content">
          <div class="overlayed-title"><strong> Kegiatan: </strong>{{ $edit->title }}</div>
          <div class="overlayed-time"><strong>Waktu Mulai:</strong> {{ $edit->start_time->isoFormat('dddd, D MMM Y HH:m') }}</div>
          <div class="overlayed-time"><strong>Berakhir: </strong>{{ $edit->finish_time->isoFormat('dddd, D MMM Y HH:m') }}</div>
          <div class="overlayed-description"><strong>Keterangan: </strong>
          <textarea class="form-control" name="keterangan" rows="4" value="">{{ $edit->keterangan }}</textarea> </div>
        </div>

        <div class="modal-footer">
            <a href="{{ route('delete_jadwal', $edit->id) }}"><button type="button" class="btn btn-danger" data-bs-toggle="modal">Delete</button>
            <button type="submit" class="btn btn-info">Save Changes</button>
        </div>
      </div>
  </form>
</body>
</html>
