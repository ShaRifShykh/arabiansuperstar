<!DOCTYPE html>
<html lang="en">

@php
    use App\Models\AppSetting;

$metaURL = AppSetting::where("key", "=", "meta_url")->first() ?? null;
$metaDescription = AppSetting::where("key", "=", "meta_description")->first() ?? null;
$metaKeywords = AppSetting::where("key", "=", "meta_keywords")->first() ?? null;

@endphp

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="@yield("title")Arabian Superstar" property="title"/>
    <meta content="{{ $metaDescription->value }}" name="description">
    <meta content="{{ $metaKeywords->value }}" name="keywords">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title")Arabian Superstar</title>

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
          integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Template Main CSS File -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    <x-embed-styles/>
    @yield("styles")
    <style>
        .lb-data .lb-close {
            position: absolute;
            top: -50px;
            margin-right: -50px;
        }
        /* Header Menu Dropdown */
        .profileDD:hover + .profileDropdown {
            display: block;
        }

        .profileDropdown:hover {
            display: block;
        }

        .profileDropdown {
            position: absolute;
            background-color: white;
            left: 40%;
            top: 95%;
            border: 1px solid #707070;
            padding: 20px 25px 15px 0px;
            border-radius: 20px;
            display: none;
        }

        .profileDropdown ul {
            list-style: none;
            font-size: 14px;
            display: block;
            font-weight: normal;
            width: 250px;
            top: 95%;
        }

        /* Search Filter Dropdown */
        #filterDropdown {
            position: absolute;
            background-color: white;
            top: 100%;
            left: 30%;
            width: 500px;
            padding: 22px;
            border-end-end-radius: 10px;
            border-end-start-radius: 10px;
            box-shadow: -2px 17px 28px -19px rgba(0, 0, 0, 0.43);
            -webkit-box-shadow: -2px 17px 28px -19px rgba(0, 0, 0, 0.43);
            -moz-box-shadow: -2px 17px 28px -19px rgba(0, 0, 0, 0.43);
            display: none;
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

        .iti--allow-dropdown input, .iti--allow-dropdown input[type=text], .iti--allow-dropdown input[type=tel], .iti--separate-dial-code input, .iti--separate-dial-code input[type=text], .iti--separate-dial-code input[type=tel] {
            width: 100%;
        }

        .iti {
            width: 100%;
        }

        .scrollContainer {
            overflow-y: scroll;
            scrollbar-width: none;
        }

        .scrollContainer::-webkit-scrollbar { /* WebKit */
            width: 0;
            height: 0;
        }

        .form-check-input[type=radio] {
            border: 1px solid grey;
        }

        #header {
            padding: 8px 0;
        }

        .navbar a, .navbar a:focus {
            color: grey;
        }

        /* clears the ‘X’ from Internet Explorer */
        input[type=search]::-ms-clear {
            display: none;
            width: 0;
            height: 0;
        }

        input[type=search]::-ms-reveal {
            display: none;
            width: 0;
            height: 0;
        }

        /* clears the ‘X’ from Chrome */
        input[type="search"]::-webkit-search-decoration,
        input[type="search"]::-webkit-search-cancel-button,
        input[type="search"]::-webkit-search-results-button,
        input[type="search"]::-webkit-search-results-decoration {
            display: none;
        }
    </style>
    @livewireStyles
</head>
<body>

@if(\Illuminate\Support\Facades\Auth::guard()->check())
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Share Profile to social media</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <a href="javascript:void(0)"
                           onclick="shareOnFacebook('{{ request()->getHttpHost() . '/share_profile/' . \Illuminate\Support\Facades\Auth::user()->username }}')">
                            <i style="color: #3b5998" class="fa-brands fa-square-facebook h2"></i>
                        </a>
                        <a href="javascript:void(0)"
                           onclick="shareOnTwitter('{{ request()->getHttpHost() . '/share_profile/' . \Illuminate\Support\Facades\Auth::user()->username }}')">
                            <i style="color: #00acee" class="fa-brands fa-square-twitter h2"></i>
                        </a>
                        <a href="javascript:void(0)"
                           onclick="shareOnLinkedin('{{ request()->getHttpHost() . '/share_profile/' . \Illuminate\Support\Facades\Auth::user()->username }}')">
                            <i style="color: #0072b1" class="fa-brands fa-linkedin h2"></i>
                        </a>
                        <a href="javascript:void(0)"
                           onclick="shareOnWhatsApp('{{ request()->getHttpHost() . '/share_profile/' . \Illuminate\Support\Facades\Auth::user()->username }}')">
                            <i style="color: #075e54" class="fa-brands fa-whatsapp-square h2"></i>
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endif

@yield("section")

@include("frontend.layout.footer")

<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short text-white"></i></a>

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

@yield("scripts")
@livewireScripts

<script>
    function resetDropdown() {
        $('#country option').each(function(){$(this).removeAttr('selected');});
        $('#gender option').each(function(){$(this).removeAttr('selected');});
    }

    function shareOnFacebook(url) {
        const navUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + url;
        window.open(navUrl, '_blank');
    }

    function shareOnTwitter(url) {
        const navUrl =
            'https://twitter.com/intent/tweet?text=' + url;
        window.open(navUrl, '_blank');
    }

    function shareOnLinkedin(url) {
        const navUrl =
            'https://www.linkedin.com/sharing/share-offsite/?url=' + url;
        window.open(navUrl, '_blank');
    }

    function shareOnWhatsApp(url) {
        const navUrl =
            'whatsapp://send?text=' + url;
        window.open(navUrl, '_blank');
    }

    $(document).ready(function(){
        $("#filterDropdownToggle").click(function(){
            $("#filterDropdown").toggle();
        });
    });

    document.addEventListener('mouseup', function (e) {
        var container = document.getElementById('filterDropdown');
        if (!container.contains(e.target)) {
            container.style.display = 'none';
        }
    });

    // ========== Phone Number Validation ==========
    $("#valid_msg").hide();

    let phone_input = document.querySelector("#phone_no");
    let valid_msg = $("#valid_msg");
    let error_msg = $("#error_msg");


    let iti = window.intlTelInput(phone_input, {
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js",
        initialCountry: "ae",
        separateDialCode: true,
        hiddenInput: "full",
    });

    // here, the index maps to the error code returned from getValidationError - see readme
    var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

    var reset = function () {
        $("#phone_no").removeClass("error");
        error_msg.html('').hide();
        valid_msg.hide();
    };

    // on blur: validate
    $("#phone_no").blur(function () {
        reset();
        if (!$("#phone_no").val().match(/^\d+/)) {
            error_msg.show().html('Invalid Number');
        } else {
            if ($("#phone_no").val().trim()) {
                if (iti.isValidNumber()) {
                    valid_msg.show();
                } else {
                    $("#phone_no").addClass("error");
                    let errorCode = iti.getValidationError();
                    error_msg.show().html(errorMap[errorCode]);
                }
            }
        }
    });

    // on keyup / change flag: reset
    $('#phone_no').change(reset);
    $('#phone_no').keyup(reset);

    $('.carousel').carousel({
        interval: 3000
    })
</script>

</body>
</html>
