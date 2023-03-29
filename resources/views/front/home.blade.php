@extends('front.layout.app')

@section('title', 'Agenda Pimpinan UNP')

@section('main_content')
    {{-- searchbar --}}
    <livewire:user-data> 
             
        <div class="container-fluid" id="calendar"></div>
        @if (session()->get('berhasil'))
        <div class="alert alert-success">{{ session()->get('berhasil') }}</div>
        @elseif (session()->get('error'))
        <div class="alert alert-danger">{{ session()->get('error') }}</div>
        @endif 
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    slotMinTime: '7:00:00',
                    slotMaxTime: '18:00:00',
                    headerToolbar: {
                        left: 'dayGridMonth,timeGridWeek,timeGridDay',
                        center: 'title',
                        right: 'today prev,next'
                    },
                    events: @json($events),
                    dayMaxEventRows: 2,
                    selectable: true,
                });
                calendar.render();
            });
        </script>
        
    @endsection
