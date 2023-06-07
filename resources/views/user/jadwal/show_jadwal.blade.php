@extends('user.home')

@section('title', 'Jadwal')


@section('main_content')
    <h1 class="h3 mb-2 text-gray-800">Jadwal</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info"><a href="{{ route('create_jadwal') }}" class="btn btn-info">
                    <i class="fas fa-plus"></i>Add Agenda</a></h6>
        </div>

        <div class="card-body">
            <div class="container-fluid" id="calendar"></div>
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
                        editable: true,
                        events: @json($events),
                        dayMaxEventRows: 2,
                        selectable: true,

                        eventClick: function(info){
                            var eventId = info.event.id;
                            window.location.href = '/user/popover/' + eventId;

                        }
                    });
                    calendar.render();
                });
            </script>



        </div>
    </div>
@endsection
