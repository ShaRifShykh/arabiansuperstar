@extends("frontend.layout.app")
@section("title", "Login | ")

@section("styles")
    <style>
        .slider1 {
            padding: 0;
        }

        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top;
        }


        .form-wrapper {
            padding: 0 15%;
        }

        form h4 {
            font-size: 30px;
            font-weight: bold;
        }

        form p {
            font-size: 15px;
            color: #686868;
        }

        .form-group {
            margin: 40px 0 0 0;
        }

        .form-control {
            border: none !important;
            border-radius: 0 !important;
            border-bottom: 1px solid rgb(174, 174, 174) !important;
            outline: none !important;
            box-shadow: none !important;
            padding: 4px 0 !important;
        }

        .form-control:focus {
            border-bottom: 1px solid red;
        }

        .form-group .forget-pass {
            font-size: 15px;
            text-align: right;
            display: block;
            padding: 10px 0;
        }

        .sign-up {
            text-transform: uppercase;
            font-weight: bold;
            color: red;
        }

        .carousel-item img {
            height: 700px;
            object-fit: cover;
        }

        .password2 {
            display: flex;
            border: none;
            padding: 2px 10px 2px 2px;
            align-items: center;
            align-content: center;
            border-bottom: 1px solid rgb(174, 174, 174) !important;
        }
    </style>
@endsection

@section("section")
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 col-md-6 slider1 d-none d-md-block">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @if($sliders != null)
                            @foreach($sliders as $key => $slider)
                                <div class="carousel-item {{ $key == 0 ? "active" : "" }}">
                                    <img src="{{ asset('storage/'.substr($slider->image, 6)) }}" class="d-block w-100"
                                         alt="...">
                                </div>
                            @endforeach
                        @else
                            <div class="carousel-item active">
                                <img src="{{ asset('frontend/img/login.jpeg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('frontend/img/signup1.jpeg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('frontend/img/signup2.jpeg') }}" class="d-block w-100" alt="...">
                            </div>
                        @endif
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="col-lg-5 col-md-6 px-3 px-sm-5 px-md-0 form scrollContainer" style="height: 700px">
                <div class="form-wrapper my-3">
                    <div class="logo mb-4 text-center">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('frontend/img/logo.png') }}"/>
                        </a>
                    </div>

                    <div style="margin: 80px 0">
                        <form action="{{ route("login") }}" method="post" class="mt-3">
                            <h4>Login</h4>
                            <p>Please login to your account</p>
                            @csrf

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" id="email" autocomplete="off"/>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="password2" id="password">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password" id="password" style="border-bottom: none !important;"/>
                                    <div class="form-group-addon eye">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <a href="{{ route('resetPassword') }}" class="forget-pass">Forget Password?</a>
                            </div>

                            @error('error')
                            <div class="mt-3">
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            </div>
                            @enderror

                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-block btn-custom">Login</button>
                            </div>

                            <div class="form-group mt-3 social-login-icons" style="text-align: center;">
                                <p style="text-align: center; margin-top: 20px;">Or login with</p>
                                <a href="{{ route('googleAuth') }}"><i style="padding: 10px;"
                                                                       class="fa-brands fa-google text-danger"></i></a>
                                <a href="{{ route('facebookAuth') }}"><i style="padding: 10px 14px 10px 14px;"
                                                                         class="fa-brands fa-facebook-f text-primary"></i></a>
                                <a href="{{ route('twitterAuth') }}"><i style="padding: 10px;"
                                                                        class="fa-brands fa-twitter text-primary"></i></a>
                            </div>

                            <div class="form-group mt-3 text-center">
                                <p>Dont have an account? <a href="{{ route("signUp") }}" class="sign-up">Sign Up </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        $(document).ready(function () {
            $("#password a").on('click', function (event) {
                event.preventDefault();
                if ($('#password input').attr("type") == "text") {
                    $('#password input').attr('type', 'password');
                    $('#password i').addClass("fa-eye-slash");
                    $('#password i').removeClass("fa-eye");
                } else if ($('#password input').attr("type") == "password") {
                    $('#password input').attr('type', 'text');
                    $('#password i').removeClass("fa-eye-slash");
                    $('#password i').addClass("fa-eye");
                }
            });
        });
    </script>
@endsection
