<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="{{ asset('dist-front/img/logounp.png') }}" />
    <title>@yield('title')</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    <!-- Custom fonts for this template-->
    @livewireStyles
    @include('front.layout.styles')
    @include('front.layout.scripts')


</head>

<body id="page-top">
    <div id="wrapper">
        {{-- @include('front.layout.sidebar') --}}
        <div div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('front.layout.nav')
                <div class="container-fluid">

                    @if (session()->get('success'))
                        <script>
                            iziToast.success({
                                title: '',
                                position: 'topRight',
                                message: '{{ session()->get('success') }}',
                            });
                        </script>
                    @endif

                    @if (session()->get('error'))
                        <script>
                            iziToast.error({
                                title: '',
                                position: 'topRight',
                                message: '{{ session()->get('error') }}',
                            });
                        </script>
                    @endif

                    @yield('main_content')
                </div>
            </div>
            @include('front.layout.footer')
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('admin_logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>
    @include('front.layout.scripts_footer')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    @livewireScripts
</body>

</html>
