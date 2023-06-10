@extends('front.layout.app')

@section('title', 'Agenda Pimpinan UNP')

@section('main_content')
    <!-- Modal -->
    <div class="modal fade" id="test" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <p class="mt-3 text-justify text-dark" id="keterangan"></p>
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

            </div>
        </div>
    </div>
    <div class="container-fluid banner mt-5">
        <div class="row container">
            <div class="col col-12 col-lg-7 pt-5 pt-lg-0">
                <h3 class="pt-lg-5 text-light font display-4">AGENDA PIMPINAN UNP</h3>
                <p class="pt-lg-5 text-light font rata" id="overflow">
                    Selamat datang di Agenda Pimpinan UNP!
                    Eksplorasi agenda terkini dari pimpinan UNP di sini.
                    Temukan kegiatan inspiratif pimpinan UNP.
                    Ikuti jejak perubahan melalui agenda kami.
                    Dapatkan wawasan mendalam dengan melihat agenda pimpinan UNP.
                    Informasi terbaru tentang agenda pimpinan UNP menanti Anda.
                    Kunjungi kami untuk mengetahui agenda terbaru dari pimpinan UNP.
                    Saksikan momen bersejarah melalui agenda pimpinan UNP.
                    Nikmati pengalaman menyeluruh dengan agenda pimpinan UNP.
                    Jelajahi dunia pimpinan UNP melalui agenda kami.
                    Mari bersama-sama melihat masa depan melalui agenda pimpinan UNP.
                </p>
            </div>
        </div>
        <div class="text-center mt-lg-2"><a href="#scroll" class="btn btn-success text-center shadow">LET'S GET
                STARTED</a></div>
    </div>

    <div id="scroll" style="height: 5vh"></div>


    <section class="mt-5">
        {{-- searchbar --}}
        <livewire:user-data>

            <div class="container-fluid" id="calendar"></div>
            <script>
                var url = window.location.pathname; // Mendapatkan path URL
                var segments = url.split('/'); // Membagi path menjadi segment
                var nama = segments[segments.length - 1]; // Mengambil ID dari segment terakhir

                var tgl;
                var title = document.getElementById('title')
                var start = document.getElementById('start')
                var end = document.getElementById('end')
                var keterangan = document.getElementById('keterangan')

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

                        eventClick: function(info) {
                            $('#test').modal('show');
                            title.innerHTML = info.event.title;
                            // start1 = info.event.start;
                            // start2 = moment(start1);
                            // start.innerHTML = start2.lang('id').format("LLLL");
                            end1 = info.event.end;
                            end2 = moment(end1);
                            end.innerHTML = end2.lang('id').format("LLLL");
                            keterangan.innerHTML = info.event.extendedProps.keterangan;
                        },
                        dayMaxEventRows: 2,
                        selectable: true,
                    });
                    // return calendar.formatRange(events);
                    calendar.render();

                    function refetchEvents() {
                        $.ajax({
                            url: '/reload/' + nama,
                            method: 'GET',
                            success: function(data) {
                                // Perbarui event di FullCalendar dengan data yang diperoleh
                                calendar.removeAllEvents();
                                calendar.addEventSource(data);
                                calendar.refetchEvents();
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }

                    // Memuat ulang event secara periodik setiap 5 detik
                    setInterval(refetchEvents, 5000);
                });
            </script>
    </section>
@endsection
