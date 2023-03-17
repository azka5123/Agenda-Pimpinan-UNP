@extends('user.home')

@section('title', 'Jadwal')




@section('main_content')
    <h1 class="h3 mb-2 text-gray-800">Jadwal</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{ route('create_jadwal') }}"
                    class="btn btn-primary">
                    <i class="fas fa-plus"></i>Add Agenda</a></h6>
        </div>

        <div class="card-body">
            

   
      <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>

      
      
      <script>

        document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
          });
          calendar.render();
        });
  
      </script>

      

      <div class="container">
         
         <div id='calendar'></div>
      </div>
@endsection






{{-- 
 @extends('user.layout.app')

@section('title', 'Jadwal')

@section('main_content')
    <h1 class="h3 mb-2 text-gray-800">Jadwal</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{ route('create_jadwal') }}"
                    class="btn btn-primary">
                    <i class="fas fa-plus"></i>Add Agenda</a></h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Dosen</th>
                            <th>Keterangan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach ($user as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user_id }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ $item->start_time }}</td>
                                <td>{{ $item->finish_time }}</td>
                                
                                <td><a href="{{ route('edit_jadwal', $item->id) }}" class="btn btn-warning"> <i
                                            class="fas fa-edit"></i>edit</a>
                                    <a href="{{ route('delete_jadwal', $item->id) }}" class="btn btn-danger"
                                        onclick="return confirm('are u sure?')"> <i class="fas fa-trash"></i>delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection  --}}
