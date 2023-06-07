@extends('user.layout.app')

@section('title', 'Jadwal')

@section('main_content')

    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <h1 class="h3 mb-2 text-gray-800">Agenda List</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div type="text" class="h3 mb-3 text-gray-800"><h5>My Agenda</h5></div>
            <div class="notcomp">
            

                @foreach ($user as $item)

                <div class="task bg-info text-white">
                   
                    {{ $loop->iteration }}. {{ $item->title }}, ( {{ $item->start_time->isoFormat('dddd, D MMM Y HH:m') }} )
                    <a href="{{ route('delete_jadwal', $item->id) }}"> <i class="fas fa-trash-alt text-white"></i></a>
                    <a href="{{ route('edit_jadwal', $item->id) }}"> <i class="fas fa-edit text-white"> Edit</i></a>
                </div>
                @endforeach

            </div>

        </div>
    </div>

@endsection 
