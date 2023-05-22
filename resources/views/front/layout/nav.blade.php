    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header mx-auto">
                    <img src="{{ asset('dist-front/img/logounp.png') }}" alt="" class="img-fluid" width="150px"
                        height="150px">
                </div>
                <div class="modal-header mx-auto">
                    <p>
                    <h3 class="font-weight-bold text-dark" id="exampleModalLabel">Login</h3>
                    </p>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user_login_submit') }}" method="POST">
                        @csrf
                        <div class="form-group text-dark">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email">
                        </div>
                        <div class="form-group text-dark">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group text-dark text-right">
                            <a class="#" href="{{ route('user_forget_password') }}">Lupa Sandi?</a>
                        </div>
                </div>
                <div class="modal-footer text-dark">
                    <input type="submit" class="btn btn-primary" value="Login">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Akhir Modal --}}

    {{-- Awal Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('front_show') }}"><img
                    src="{{ asset('dist-front/img/logounp.png') }}" alt="" width="50px" height="50px"><span
                    class="font-weight-bold mt-1"> AGENDA PIMPINAN UNP</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active ml-3 {{ Request::is('search/*') ? '' : 'mt-2' }}">
                        <a class="nav-link" href="{{ route('front_show') }}"><i class="fas fa-fw fa-home"></i> Home<span
                                class="sr-only"></span></a>
                    </li>
                    @if (Request::is('search/*'))
                        <li class="nav-item active mr-3">
                            <a class="nav-link"><span class="mt-1"><i class="fas fa-fw fa-user"></i>
                                    {{ $user->nama }} - {{ $user->jabatan }}</span></a>
                        </li>
                    @else
                        <li class="nav-item active {{ Request::is('search/*') ? '' : 'mt-2' }}">
                            <a class="nav-link"><span class="mt-1"><i class="fas fa-fw fa-user"></i>
                        </li>
                    @endif

                    <li class="nav-item">
                        <!-- Button trigger modal -->
                        <a type=""
                            class="btn btn-outline-light rounded-pill text-light text-decoration-none d-lg-flex justify-content-end {{ Request::is('search/*') ? '' : 'mt-n2' }}"
                            data-toggle="modal" data-target="#exampleModal" href="#">
                            <img src="{{ asset('dist-front/img/login.png') }}" alt="" width="17px"
                                height="17px" class="d-lg-mr-2 d-lg-mt-1 mr-2 mt-1"> Login</a>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- Akhir Navbar --}}
