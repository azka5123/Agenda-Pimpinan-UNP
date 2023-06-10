@extends('user.home')

@section('title', 'Jadwal')


@section('main_content')
    <h1 class="h3 mb-2 text-gray-800">Jadwal</h1>
    <!-- Modal -->
    <div class="modal fade" id="detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <p class="modal-title mt-3" id="exampleModalLabel">
                    <p class="my-auto">
                        <i class='fas fa-calendar-check'></i>&nbsp;
                        <span id="title"></span>
                    </p>
                    </p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="container">
                    <div class="modal-body">
                        <table border="0">
                            {{-- <tr>
                            <td>
                                <p class="mt-3" id="start"></p>
                            </td>
                        </tr> --}}
                            <tr>
                                <td>
                                    <p class="mt-3 text-justify text-dark" id="ket"></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="d-flex justify-content-end text-dark">
                                    <span class="mt-3">Selesai &nbsp;</span>
                                    <p class="mt-3" id="end"></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="edit" class="btn btn-sm btn-success rounded-pill px-4"><i
                            class="fas fa-edit text-white"></i>
                        Edit</a>
                    <a id="del" class="btn btn-sm btn-danger rounded-pill px-3"><i
                            class="fas fa-trash text-white"></i>
                        Delete</a>
                </div>
            </div>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info"><a href="{{ route('create_jadwal') }}" class="btn btn-info">
                    <i class="fas fa-plus"></i>Add Agenda</a></h6>
        </div> --}}

        <div class="card-body">
            <div class="container-fluid" id="calendar"></div>
            <script>
                var eventId
                var title = document.getElementById('title')
                var start = document.getElementById('start')
                var end = document.getElementById('end')
                var keterangan = document.getElementById('ket')
                var edit = document.getElementById('edit')
                var del = document.getElementById('del')
                var time
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
                        eventClick: function(info) {
                            eventId = info.event.id;
                            $('#detail').modal('show');
                            title.innerHTML = info.event.title;
                            end1 = info.event.end;
                            end2 = moment(end1);
                            end.innerHTML = end2.lang('id').format("LLLL");
                            ket.innerHTML = info.event.extendedProps.keterangan;
                        },
                        dateClick: function(info) {
                            handleDateClick(info.date);
                            // window.location.href = '/user/create/jadwal?time=';
                        },
                    });
                    calendar.render();
                    edit.addEventListener('click', function() {
                        window.location.href = '/user/edit/jadwal/' + eventId;
                    });
                    del.addEventListener('click', function() {
                        window.location.href = '/user/delete/jadwal/' + eventId;
                    });
                });

                function handleDateClick(dateStr) {
                    var now = new Date();
                    var currentTime = now.getHours().toString().padStart(2, '0') + ':' +
                        now.getMinutes().toString().padStart(2, '0') + ':' +
                        now.getSeconds().toString().padStart(2, '0');
                    var formattedDate = dateStr.getFullYear() + '-' +
                        (dateStr.getMonth() + 1).toString().padStart(2, '0') + '-' +
                        dateStr.getDate().toString().padStart(2, '0');
                    var dateTime = formattedDate + 'T' + currentTime;
                    // Store the clicked date in a global variable or localStorage
                    localStorage.setItem('selectedDate', dateTime);
                    // Redirect to the other Blade view
                    window.location.href = '/user/create/jadwal';
                }
            </script>



        </div>
    </div>
@endsection
