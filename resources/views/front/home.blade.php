@extends('front.layout.app')

@section('title', 'Agenda Pimpinan UNP')

@section('main_content')
    <div class="container-fluid banner mt-5">
        <div class="row">
            <div class="col col-7 pt-5">
                <p class="pt-5 text-light font">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis laudantium
                    autem officiis, quasi, vero minima ab sed quaerat quidem est cum. Cum sit est reprehenderit iste
                    pariatur amet in aliquam quas itaque id tempore assumenda molestias sapiente, facilis illum totam
                    possimus mollitia. Repellendus quidem minus quibusdam dolor quaerat consequuntur nesciunt ab voluptatem
                    id! Veniam dolorem, eius nulla voluptates aut exercitationem in modi eaque repellendus ipsa sapiente
                    esse quae explicabo id voluptatibus saepe cum? Officia, recusandae officiis modi, ullam totam
                    repudiandae maiores voluptates atque neque quasi sapiente quibusdam voluptatibus placeat voluptas
                    doloribus ipsum nulla. Nulla incidunt maxime suscipit dicta facere amet quasi quos accusamus similique
                    eligendi laborum, ad, fugiat in porro dolorum fuga praesentium impedit deserunt repudiandae, itaque eos!
                    Error blanditiis consequuntur dolor quos rem corrupti facilis, provident placeat fugiat incidunt vero
                    facere quas ab laboriosam natus deleniti tenetur molestias sapiente neque dolorum suscipit dicta eveniet
                    laudantium tempora. Ipsa expedita officia aliquam voluptates commodi quas maxime, hic unde ipsam nemo
                    exercitationem atque dolorum adipisci molestiae nobis quis ad cum quo ex quibusdam. Ratione atque maxime
                    et doloribus dolorum? Hic amet error et laboriosam officia fuga, iste temporibus repudiandae
                    perspiciatis obcaecati praesentium facilis enim perferendis eaque deleniti fugit doloribus ducimus neque
                    sit?</p>
            </div>
        </div>
        <div class="text-center mt-5"><a href="#start" class="btn btn-success text-center shadow">LET'S GET STARTED</a></div>
    </div>


    <div id="start" data-aos="fade-down" data-aos-duration="1000" class="mt-5">
        {{-- searchbar --}}
        <livewire:user-data>

            <div class="container-fluid" id="calendar"></div>
            <script>
                var url = window.location.pathname; // Mendapatkan path URL
                var segments = url.split('/'); // Membagi path menjadi segment
                var nama = segments[segments.length - 1]; // Mengambil ID dari segment terakhir


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
