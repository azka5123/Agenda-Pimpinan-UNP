{{-- <script src="{{ asset('dist/js/jquery-3.6.0.min.js') }}"></script> --}}
{{-- <script src="{{ asset('dist/js/iziToast.min.js') }}"></script>
<script src="{{ asset('dist/js/summernote-bs4.js') }}"></script>

<script src="{{ asset('dist-front/js/calender.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src='http://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script> --}}

<script src="{{ asset('dist-front/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('dist-front/js/iziToast.min.js') }}"></script>
<script src="{{ asset('dist-front/js/summernote-bs4.js') }}"></script>
<script src="{{ asset('dist-front/js/calender.js') }}"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
{{-- <script src="{{ asset('dist-front/js/notif.js') }}"></script> --}}

<script>
    function listNotif() {
        $.ajax({
            url: "{{ route('unread') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                var notifications = data.notifications;
                var html = '';
                if (notifications.length > 0) {

                    for (var i = 0; i < notifications.length; i++) {
                        html += '<div class="row mb-3">';
                        html += '<div class="col col-3">';

                        html += '<div class="mr-3 mt-3">';
                        html += '<div class="icon-circle bg-warning">';
                        html += '<i class="fas fa-exclamation-triangle text-white"></i>';
                        html += '</div></div></div>'

                        html += '<div class="col col-9">';
                        html += '<div class="small text-gray-500">';
                        html += "{{ Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}";
                        html += '</div>';
                        html += '<div>';
                        html += JSON.parse(notifications[i].data);
                        html += '</div>';
                        html += '</div>';

                        html += '</div>';
                    }
                }
                $('#keterangan').html(html);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    }

    $(document).ready(function() {
        listNotif();
        setInterval(listNotif, 5000); // Refresh notifikasi setiap 30 detik
    });
</script>

<script>
    function getUnreadNotifications() {
        $.ajax({
            url: "{{ route('unread') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                var notifications = data.notifications;
                var count = notifications.length;
                if (count > 0) {
                    $('#jumlah-notif').html(count);
                } else {
                    $('#jumlah-notif').html('0');
                }
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    }

    $(document).ready(function() {
        getUnreadNotifications();
        setInterval(getUnreadNotifications, 30000); // Refresh notifikasi setiap 30 detik
    });
</script>





{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.js" integrity="sha512-OmBbzhZ6lgh87tQFDVBHtwfi6MS9raGmNvUNTjDIBb/cgv707v9OuBVpsN6tVVTLOehRFns+o14Nd0/If0lE/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
{{-- 
<script src="{{ asset('dist/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('dist/js/popper.min.js') }}"></script>
<script src="{{ asset('dist/js/tooltip.js') }}"></script>
<script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dist/js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('dist/js/moment.min.js') }}"></script>
<script src="{{ asset('dist/js/stisla.js') }}"></script>
<script src="{{ asset('dist/js/jscolor.js') }}"></script>
<script src="{{ asset('dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('dist/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('dist/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('dist/js/popper.min.js') }}"></script>
<script src="{{ asset('dist/js/tooltip.js') }}"></script>
<script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dist/js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('dist/js/moment.min.js') }}"></script>
<script src="{{ asset('dist/js/stisla.js') }}"></script>
<script src="{{ asset('dist/js/jscolor.js') }}"></script> --}}
{{-- <script src="{{ asset('dist/js/scripts.js') }}"></script>
<script src="{{ asset('dist/js/custom.js') }}"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script> --}}
