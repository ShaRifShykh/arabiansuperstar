<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" property="title"/>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Login | Arabian Superstar Admin Panel</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('frontend/img/favicon.png') }}" type="image/x-icon">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Google Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/owl/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/owl/assets/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/lightbox/css/lightbox.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('frontend/vendor/intl-tel/css/intlTelInput.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css"
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Template Main CSS File -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    <style>
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

        .password {
            display: flex;
            border: 1px solid rgb(83, 74, 74);
            border-radius: 8px;
            padding: 2px 10px 2px 2px;
            align-items: center;
            align-content: center;
        }
        .password input {
            box-shadow: none;
            border: none;
            outline: none;
        }
        .password input:focus {
            box-shadow: none;
            border: none;
            outline: none;
        }
        .password i {
            font-size: 18px;
        }

        .social-icons i {
            padding: 12px 12px 12px 12px;
            border: 1px solid gray;
            border-radius: 50%;
            margin: 2px;
            color: gray;
        }
    </style>

</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-3"></div>

        <div class="col-lg-6 col-md-12 col-sm-12 form" style="padding: 0px 150px 0px 150px;">
            <div class="logo me-auto mt-4 text-center">
                <a href="{{ route('home') }}">
                    <img class="img-fluid" src="{{ asset('frontend/img/logo.png') }}"/>
                </a>
            </div>

            <div class="mt-5 mb-5">
                <h4 class="fw-bolder">Login</h4>

                <p>Please login to admin dashboard</p>

                <form action="{{ route("admin.auth.signIn") }}" method="post" class="mt-3">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}" id="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="password">Password</label>
                        <div class="password" id="password">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" id="password">
                            <div class="form-group-addon">
                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
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

                    <div class="d-grid mt-3">
                        <button type="submit" class="btn btn-block btn-custom">Login</button>
                    </div>

                </form>
            </div>
        </div>

        <div class="col-3"></div>
    </div>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="{{ asset('frontend/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/owl/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/intl-tel/js/intlTelInput.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"
        integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Template Main JS File -->
<script src="{{ asset('frontend/js/main.js') }}"></script>

<script>
    $(document).ready(function() {
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
</script>

</body>
</html>
