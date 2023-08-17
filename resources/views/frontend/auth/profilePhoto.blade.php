@extends("frontend.layout.app")
@section("title", "Upload Profile Photo | ")

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

        .personal-image {
            text-align: center;
        }
        .personal-image input[type="file"] {
            display: none;
        }
        .personal-figure {
            position: relative;
            width: 120px;
            height: 120px;
        }
        .personal-avatar {
            cursor: pointer;
            width: 120px;
            height: 120px;
            box-sizing: border-box;
            border-radius: 100%;
            border: 2px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
            transition: all ease-in-out .3s;
        }
        .personal-avatar:hover {
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.5);
        }
        .personal-figcaption {
            cursor: pointer;
            position: absolute;
            top: 0px;
            width: inherit;
            height: inherit;
            border-radius: 100%;
            opacity: 0;
            background-color: rgba(0, 0, 0, 0);
            transition: all ease-in-out .3s;
        }
        .personal-figcaption:hover {
            opacity: 1;
            background-color: rgba(0, 0, 0, .5);
        }
        .personal-figcaption > img {
            margin-top: 32.5px;
            width: 50px;
            height: 50px;
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


            <div class="col-lg-5  col-md-12 col-sm-12 form scrollContainer" style="padding: 0px 150px 0px 150px; height: 700px">
                <div class="logo me-auto mt-4 text-center"><a href="{{ route("home") }}">
                        <img class="img-fluid" src="{{ asset('frontend/img/logo.png') }}" alt="..."/>
                    </a>
                </div>

                <div class="mt-5 mb-5">
                    <h4 class="fw-bolder">Profile Photo</h4>

                    <form action="{{ route("addProfilePhoto") }}" enctype="multipart/form-data" method="post" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="profile_photo">Profile Photo</label>

                            <div class="personal-image mt-3">
                                <label class="label">
                                    <input type="file" id="profile_photo" name="profile_photo"
                                           accept="image/*" onchange="getImage(event);" />
                                    <figure class="personal-figure">
                                        @if($user->profile_photo)
                                            <img style="object-fit: cover" src="{{ asset('storage/'.substr($user->profile_photo, 6)) }}" id="avatar" class="personal-avatar" alt="....">
                                        @else
                                            <img style="object-fit: cover" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNL_ZnOTpXSvhf1UaK7beHey2BX42U6solRA&usqp=CAU" id="avatar" class="personal-avatar" alt="avatar">
                                        @endif
                                        <figcaption class="personal-figcaption">
                                            <img style="object-fit: cover" src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png" alt="....">
                                        </figcaption>
                                    </figure>
                                </label>
                            </div>

                            @error('profile_photo')
                            <div class="mt-3">
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            </div>
                            @enderror
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-block btn-custom">Complete</button>
                        </div>

                        <div class="text-center mt-5">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route("addBioView") }}">
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

@section("scripts")
    <script>
        function getImage(event) {
            let output = document.getElementById('avatar');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        }
    </script>
@endsection
