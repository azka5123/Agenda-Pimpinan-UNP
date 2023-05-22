{{-- <script src="{{ asset('dist/js/jquery-3.6.0.min.js') }}"></script> --}}
{{-- <script src="{{ asset('dist/js/iziToast.min.js') }}"></script>
<script src="{{ asset('dist/js/summernote-bs4.js') }}"></script>

<script src="{{ asset('dist-front/js/calender.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src='http://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script> --}}

<script src="{{ asset('dist-front/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
        setInterval(getUnreadNotifications, 10000); // Refresh notifikasi setiap 10 detik
    });
</script>

<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" defer></script>

<script>
    var id;
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId: "b1bb6f27-a837-43a5-b1a1-1da2720d0cff",
            safari_web_id: "web.onesignal.auto.162dc776-ab2c-42c2-8206-1135116280d4",
            notifyButton: {
                enable: true,
            },
            subdomainName: "agenda-hari",
        });

    });
</script>
