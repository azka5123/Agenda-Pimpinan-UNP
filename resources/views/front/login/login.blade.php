<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" type="image/png" href="uploads/favicon.png">
    <title>login</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    @include('front.layout.styles')
    @include('front.layout.scripts')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <section class="section">
                <div class="container container-login border-box">
                    <div class="row">
                        <div
                            class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                            <div class="card card-primary border-box">
                                @if (session()->get('berhasil'))
                                    <div class="alert alert-success">{{ session()->get('berhasil') }}</div>
                                @elseif (session()->get('error'))
                                    <div class="alert alert-danger">{{ session()->get('error') }}</div>
                                @endif
                                <div class="card-header card-header-auth" >
                                    <h4 class="text-center">Login</h4>
                                </div>
                                <div class="card-body card-body-auth">
                                    <form method="POST" action="{{ route('user_login_submit') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Email Address" value="{{ old('email') }}" autofocus>
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            @if (session()->get('error'))
                                                <div class="text-danger">{{ session()->get('error') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Password">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-lg btn-block" value="asd">
                                           
                                        </div> --}}
                                        <div class="form-group">
                                            <div>
                                                <a href="{{ route('user_forget_password') }}">
                                                    Forget Password?
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @include('front.layout.scripts_footer')

</body>

</html>
