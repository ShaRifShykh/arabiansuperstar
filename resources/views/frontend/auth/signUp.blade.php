@extends("frontend.layout.app")
@section("title", "Sign Up | ")

@section("styles")
    <style>
        .slider1 {
            padding: 0;
        }
        .form-control {
            border: 1px solid rgb(83, 74, 74);
        }
        .form-control:focus {
            box-shadow: none;
            border: 1px solid red;
            outline: 0 none;
        }
        @media screen and (max-width: 600px) {
            .form {
                padding: 0px 80px 0px 80px !important;
                margin: 50px 0px 20px 0px !important;
            }
        }
        .carousel-item img {
            height: 700px;
            object-fit: cover;
        }

        .carousel-item{
            transition: 0s !important;
        }
    </style>
@endsection

@section("section")
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-2"></div> -->
            <div class="col-lg-7 col-md-6 slider1 d-none d-md-block">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                         @if($sliders != null)
                            @foreach($sliders as $key => $slider)
                                <div class="carousel-item {{ $key == 0 ? "active" : "" }}">
                                    <img src="{{ asset('storage/'.substr($slider->image, 6)) }}" class="d-block w-100" alt="...">
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


            <div class="col-lg-5 col-md-12 col-sm-12 form scrollContainer" style="padding: 0px 100px 0px 100px; height: 700px">
                <div class="logo me-auto mt-4 text-center"><a href="{{ route("home") }}">
                        <img class="img-fluid" src="{{ asset('frontend/img/logo.png') }}"/>
                    </a>
                </div>

                <div class="mt-5 mb-5">
                    <h4 class="fw-bolder">Sign Up</h4>
                    <p>Please sign up to create new account</p>


                    <form action="{{ route("signUp") }}" method="post" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input onkeyup="generateUsername(this)" type="text" class="form-control @error('full_name') is-invalid @enderror"
                                   name="full_name"
                                   value="{{ old('full_name') }}" id="full_name">
                            @error('full_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                   name="username" readonly
                                   value="{{ old("username") }}" id="username">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old("email") }}" id="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="phone_no">Mobile No</label>
                            <input type="tel" class="form-control @error('phone_no') is-invalid @enderror"
                                   name="phone_no" value="{{ old('phone_no') }}" id="phone_no">
                            <span id="valid_msg" class="hide">✓ Valid</span>
                            <span id="error_msg" class="hide"></span>
                            @error('text-danger')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3 has-validation">
                            <label for="password">Password</label>
                            <div class="password" id="password">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" id="password">
                                <div class="form-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            @error('password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3 has-validation">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="password" id="password_confirmation">
                                <input type="password"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       name="password_confirmation" id="password_confirmation">
                                <div class="form-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            @error('password_confirmation')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        @error('error')
                        <div class="mt-3">
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        </div>
                        @enderror

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-block btn-custom">Next</button>
                        </div>

                        <div class="form-group mt-3 social-login-icons" style="text-align: center;">
                            <p style="text-align: center; margin-top: 20px;">Or login with</p>
                            <a href="{{ route('googleAuth') }}"><i style="padding: 10px;"
                                           class="fa-brands fa-google-plus-g text-danger"></i></a>
                            <a href="{{ route('facebookAuth') }}"><i style="padding: 10px 14px 10px 14px;"
                                           class="fa-brands fa-facebook-f text-primary"></i></a>
                            <a href="{{ route('twitterAuth') }}"><i style="padding: 10px;" class="fa-brands fa-twitter text-primary"></i></a>
                        </div>

                        <div class="form-group mt-3 text-center">
                            <span>Already have an account? </span><a href="{{ route("loginView") }}">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

    <script>
        function generateUsername(input) {
            let range = Math.floor(Math.random() * 99999);
            $("#username").val(input.value.replace(/\s/g, '') + range)
        }

        $(document).ready(function() {
            $("#password_confirmation a").on('click', function(event) {
                event.preventDefault();
                if($('#password_confirmation input').attr("type") == "text"){
                    $('#password_confirmation input').attr('type', 'password');
                    $('#password_confirmation i').addClass( "fa-eye-slash" );
                    $('#password_confirmation i').removeClass( "fa-eye" );
                }else if($('#password_confirmation input').attr("type") == "password"){
                    $('#password_confirmation input').attr('type', 'text');
                    $('#password_confirmation i').removeClass( "fa-eye-slash" );
                    $('#password_confirmation i').addClass( "fa-eye" );
                }
            });

            $("#password a").on('click', function(event) {
                event.preventDefault();
                if($('#password input').attr("type") == "text"){
                    $('#password input').attr('type', 'password');
                    $('#password i').addClass( "fa-eye-slash" );
                    $('#password i').removeClass( "fa-eye" );
                }else if($('#password input').attr("type") == "password"){
                    $('#password input').attr('type', 'text');
                    $('#password i').removeClass( "fa-eye-slash" );
                    $('#password i').addClass( "fa-eye" );
                }
            });
        });

        $("form").validate({
            rules: {
                phone_number: {
                    required: true,
                    phone: true // Validate the phone number using the "phone" rule
                }
            }
        });

    </script>
@endsection
