@extends("frontend.layout.app")
@section("title", "Email Verification Sent! | ")

@section("styles")
    <style>
        .slider1 {
            padding: 0;
        }

        .form-control, .form-select {
            border: 1px solid rgb(83, 74, 74);
        }

        .form-control:focus, .form-select:focus, .form-check-input:focus {
            box-shadow: none;
            border: 1px solid red;
            outline: 0 none;
        }

        .form-group i {
            font-size: 28px;
        }

        /*Form Input Checkbox*/
        .form-check {
            width: 150px;
            margin-top: 10px;
            position: relative;
        }
        .form-check input[type="radio"] {
            border-radius: 10px;
            width: 100%;
            height: 50px;
            border: 1px solid red;
            -webkit-appearance: none;
            appearance: none;
            margin: 0;
        }
        .form-check input[type="radio"]:checked {
            background: linear-gradient(180deg, rgba(204, 45, 58, 1) 0%, rgba(93, 47, 19, 1) 100%);
        }

        .form-check input[type="radio"]:checked + .form-check-label {
            color: white;
        }

        .form-check label {
            position: absolute;
            left: 40%;
            top: 20%;
            /*right: 20%;*/
            align-items: center;
            justify-content: center;
            color: black;
        }
        .form-check label:checked {
            color: white;
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
    </style>
@endsection

@section("section")
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-2"></div> -->
            <div class="col-lg-7 col-md-12 col-sm-12 slider1">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('frontend/img/signup1.jpeg') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('frontend/img/signup2.jpeg') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('frontend/img/signup3.jpeg') }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-5  col-md-12 col-sm-12 form" style="padding: 0px 150px 0px 150px;">
                <div class="logo me-auto mt-4 text-center"><a href="{{ route("home") }}">
                        <img class="img-fluid" src="{{ asset('frontend/img/logo.png') }}" alt="..."/>
                    </a>
                </div>

                <div class="mt-5 mb-5">
                    <h4 class="fw-bolder">Verification Email code has been sent!</h4>
                    <form action="{{ route('verifyMail') }}" method="post" class="mt-5">
                        @csrf
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" name="code" required
                                   value="{{ old('email') }}" id="code">
                            @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        @if(session('error'))
                            <div class="mt-4">
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ session('error') }}</strong>
                                </div>
                            </div>
                        @endif
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-block btn-custom">Verify Email</button>
                        </div>
                        <div class="form-group mt-3 text-center">
                            <span>Didn't received email? </span><a href="{{ route("resendVerificationCode") }}">Resend Verification Code.</a>
                        </div>

                        <div class="text-center mt-5">
                            <div class="d-flex">
                                <a href="{{ route("logout") }}">
                                    <i class="fa-solid fa-chevron-left"></i>
                                    <span>Back</span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
