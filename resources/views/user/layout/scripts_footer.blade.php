{{-- <script src="{{ asset('dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('dist/js/bootstrap-timepicker.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script> --}}



<!-- Bootstrap core JavaScript-->
<script src="{{ asset('dist/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dist/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"
    integrity="sha512-42PE0rd+wZ2hNXftlM78BSehIGzezNeQuzihiBCvUEB3CVxHvsShF86wBWwQORNxNINlBPuq7rG4WWhNiTVHFg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('dist/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('dist/js/sb-admin-2.min.js') }}"></script>
{{-- 
<!-- Page level plugins -->
<script src="{{ asset('dist/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('dist/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>


<!-- Page level custom scripts -->
<script src="{{ asset('dist/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('dist/js/demo/chart-pie-demo.js') }}"></script>
<script src="{{ asset('dist/js/demo/datatables-demo.js') }}"></script> --}}

<script>
    // Ambil referensi elemen select date
    var selectedDate = localStorage.getItem('selectedDate');
    var select = moment(selectedDate);
    var select2 = select.local().format("YYYY-MM-DD HH:mm");
    var date1 = document.getElementById('date1')
    var date2 = document.getElementById('date2')
    // Tambahkan event listener pada date2
    date1.value = select2;
    date2.value = select2;
    localStorage.removeItem('selectedDateTime');
    date2.addEventListener('change', function() {

        if (date2.value < date1.value) {
            iziToast.error({
                // title: 'Error',
                message: 'tanggal berakhir harus lebih besar dari tanggal mulai',
                position: 'topRight'
            });
            date2.value = date1.value;
        }
    });
    date1.addEventListener('change', function() {

        if (date1.value > date2.value) {
            iziToast.error({
                // title: 'Error',
                message: 'tanggal mulai harus lebih kecil dari tanggal berakhir',
                position: 'topRight'
            });
            date1.value = date2.value;
        }
    });
</script>
