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
    <meta content="Edit Profile | Arabian Superstar" property="title"/>
    <meta content="{{ $metaDescription->value }}" name="description">
    <meta content="{{ $metaKeywords->value }}" name="keywords">

    <title>Edit Profile | Arabian Superstar</title>

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

    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>

    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>-->
    <!------ Include the above in your HEAD tag ---------->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/vendor/aos/aos.css') }}" rel="stylesheet">
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

    <style>
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
            left: 27%;
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

        /*.password {*/
        /*    display: flex;*/
        /*    border: 1px solid rgb(83, 74, 74);*/
        /*    border-radius: 8px;*/
        /*    padding: 2px 10px 2px 2px;*/
        /*    align-items: center;*/
        /*    align-content: center;*/
        /*}*/
        /*.password input {*/
        /*    box-shadow: none;*/
        /*    border: none;*/
        /*    outline: none;*/
        /*}*/
        /*.password input:focus {*/
        /*    box-shadow: none;*/
        /*    border: none;*/
        /*    outline: none;*/
        /*}*/
        /*.password i {*/
        /*    font-size: 18px;*/
        /*}*/
        .navbar {
            margin: 0;
        }

        .active {
            color: var(--bs-dark) !important;
        }

        label {
            color: gray;
            font-size: 15px;
        }

        textarea {
            height: 140px;
        }

        .iti--allow-dropdown input, .iti--allow-dropdown input[type=text], .iti--allow-dropdown input[type=tel], .iti--separate-dial-code input, .iti--separate-dial-code input[type=text], .iti--separate-dial-code input[type=tel] {
            width: 100%;
        }

        .iti {
            width: 100%;
        }

        .select {
            display: flex;
            flex-wrap: wrap;
        }

        .select__item {
            margin-right: 5px;
            margin-bottom: 5px;
            padding: 10px 15px 10px 15px;
            cursor: pointer;
            text-align: center;
            border-radius: 10px;
            font-size: 12px;
            border: 0.5px solid red;
            transition: background 0.1s;
        }

        .select__item--selected {
            background: linear-gradient(180deg, rgba(204, 45, 58, 1) 0%, rgba(93, 47, 19, 1) 100%);
            color: #ffffff;
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
</head>
<body>
@livewire('frontend.layout.header')

<div class="container" style="margin-top: 100px; margin-bottom: 150px">

    <div class="row my-3">
        <div class="col-sm-12"><h2 class="mb-4 text-center">Edit Profile</h2></div>
        @if(session('error'))
            <div class="col-sm-12 mt-2">
                <div class="alert alert-success" role="alert">
                    <strong>{{ session('error') }}</strong>
                </div>
            </div>
        @endif
    </div>


    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link text-danger active" id="nav-profile-tab" data-bs-toggle="tab"
                    data-bs-target="#profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="true">Profile
            </button>
            <button class="nav-link text-danger" id="nav-image-tab" data-bs-toggle="tab" data-bs-target="#images"
                    type="button" role="tab" aria-controls="nav-image" aria-selected="false">Images
            </button>
            <button class="nav-link text-danger" id="nav-video-tab" data-bs-toggle="tab" data-bs-target="#videos"
                    type="button" role="tab" aria-controls="nav-video" aria-selected="false">Videos
            </button>
            <button class="nav-link text-danger" id="nav-url-tab" data-bs-toggle="tab" data-bs-target="#urls"
                    type="button" role="tab" aria-controls="nav-url" aria-selected="false">Urls
            </button>
            <button class="nav-link text-danger" id="nav-password-tab" data-bs-toggle="tab"
                    data-bs-target="#changePassword" type="button" role="tab" aria-controls="nav-password"
                    aria-selected="false">Change Password
            </button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane py-5 fade show active" id="profile" role="tabpanel" aria-labelledby="nav-profile-tab"
             tabindex="0">
            <form class="form" action="{{ route('updateProfile') }}" method="post" id="registrationForm"
                  enctype="multipart/form-data">
                @csrf
                <div class="row mb-4">
                    <div class="col-12">

                        <div class="form-group text-center">
                            <label for="profile_photo">Profile Photo</label>

                            <div class="personal-image mt-3">
                                <label class="label">
                                    <input type="file" id=profile_photo" name="profile_photo"
                                           accept="image/*" onchange="getImage(event);"/>
                                    <figure class="personal-figure">
                                        @if($user->profile_photo)
                                            <img style="object-fit: cover"
                                                 src="{{ asset('storage/'.substr($user->profile_photo, 6)) }}"
                                                 id="avatar" class="personal-avatar" alt="....">
                                        @else
                                            <img style="object-fit: cover"
                                                 src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNL_ZnOTpXSvhf1UaK7beHey2BX42U6solRA&usqp=CAU"
                                                 id="avatar" class="personal-avatar" alt="avatar">
                                        @endif
                                        <figcaption class="personal-figcaption">
                                            <img style="object-fit: cover"
                                                 src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png"
                                                 alt="....">
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
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name"
                               value="{{ $user->full_name }}" required/>
                    </div>

                    <div class="col-6">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" disabled readonly
                               placeholder="Username" value="{{ $user->username }}"/>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                               value="{{ $user->email }}" required/>
                        @error('email')
                        <div class="mt-3">
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        </div>
                        @enderror
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone_no">Mobile No</label><br>
                            <input type="tel" class="form-control @error('phone_no') is-invalid @enderror"
                                   name="phone_no" value="{{ $user->phone_no }}" id="phone_no">
                            <span id="valid_msg" class="hide">✓ Valid</span>
                            <span id="error_msg" class="hide"></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                        <label for="country">Country</label>
                        <select class="form-control" name="country" id="country" required>
                            <option selected disabled>Choose Country</option>
                            @foreach($countries as $country)
                                <option
                                    {{ $user->country == $country->name ? "selected" : null }} value="{{ $country->name }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="nationality">Nationality</label>
                        <select class="form-control" name="nationality" id="nationality" required>
                            <option selected disabled>Choose Nationality</option>
                            @foreach($nationalities as $nationality)
                                <option
                                    {{ $user->nationality == $nationality->name ? "selected" : null }} value="{{ $nationality->name }}">{{ $nationality->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                        <label for="date_of_birth">Date of Birth</label>
                        <input onchange="getZodiacSign(this.value)" type="date" value="{{ $user->date_of_birth }}"
                               class="form-control" id="date_of_birth" name="date_of_birth" required/>
                    </div>

                    <div class="col-6">
                        <label for="zodiac">Zodiac</label>
                        <input type="text" value="{{ $user->zodiac }}" class="form-control" id="zodiac" name="zodiac"
                               readonly/>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                        <label for="hobbies">Hobbies <span style="font-size: 12px; color: grey">: (for e.g., Sports, Music, Reading) - Limit 50 words </span></label>
                        <textarea class="form-control" id="hobbies" required maxlength="150"
                                  name="hobbies">{{ $user->hobbies }}</textarea>
                        <span style="font-size: 12px; color: grey">Max words: <span
                                id="bioCount">50</span></span>
                    </div>

                    <div class="col-6">
                        <label for="bio">Bio</label>
                        <textarea class="form-control" id="bio" required maxlength="300"
                                  name="bio">{{ $user->bio }}</textarea>
                        <span style="font-size: 12px; color: grey">Max words: <span
                                id="bioCount">100</span></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="gender">Gender</label>
                        <select onchange="genderChange(this)" class="form-control" name="gender" id="gender" required>
                            <option selected disabled>Choose Gender</option>
                            <option {{ $user->gender === "Male" ? "selected" : null }} value="Male">Male</option>
                            <option {{ $user->gender === "Female" ? "selected" : null }} value="Female">Female</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <div class="form-group" id="maleNominations">
                            <label for="nominations">Nominations</label>
                            <select multiple class="custom-select @error('nominations') is-invalid @enderror"
                                    name="maleNominations[]" id="nominations">
                                @foreach($maleNominations as $nomination)
                                    <option
                                        {{ collect($userSelectedNomination)->contains($nomination->id) ? "selected" : null }}
                                        {{ $nomination->id == 1 ? "selected" : null }} value={{ $nomination->id }}>{{ $nomination->name }}</option>
                                @endforeach
                            </select>
                            @error('nominations')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="femaleNominations">
                            <label for="nominations">Nominations</label>
                            <select multiple class="custom-select @error('nominations') is-invalid @enderror"
                                    name="femaleNominations[]" id="nominations">
                                @foreach($femaleNominations as $nomination)
                                    <option
                                        {{ collect($userSelectedNomination)->contains($nomination->id) ? "selected" : null }}
                                        {{ $nomination->id == 1 ? "selected" : null }} value="{{ $nomination->id }}">{{ $nomination->name }}</option>
                                @endforeach
                            </select>
                            @error('nominations')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mt-2">
                    <button class="btn btn-custom" type="submit">Update</button>
                </div>
            </form>
        </div>

        <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="nav-image-tab" tabindex="0">
            @if($user->galleries->count() < 21)
                <form class="mt-5" method="POST" action="{{ route('insertImage') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-5 mb-2">
                        <label for="video">Add Image</label>
                        <input type="file" class="form-control" id="image" required name="image" accept="image/*"/>
                    </div>

                    <div class="col-5 mb-2">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" maxlength="30" name="description"
                                      id="description"></textarea>
                            <span style="font-size: 12px; color: grey">Max characters: <span
                                    id="bioCount">30</span></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-custom" type="submit">Add Image</button>
                    </div>
                </form>
            @endif

            <div class="row mb-4 mt-5">
                @foreach($user->galleries as $gallery)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            <div style="width: 100%; height: 220px;">
                                <img class="card-img-top"
                                     style="width: 100%; height: 100%; object-fit: cover; object-position: top;"
                                     src="{{ asset('storage/'.substr($gallery->image, 6)) }}" alt="Title">
                            </div>
                            <div class="card-body">
                                <p class="card-text my-3">{{ $gallery->description }}</p>
                                <div class="mt-3">
                                    <a data-bs-toggle="modal" data-bs-target="#editGallery{{ $gallery->id }}"
                                       class="btn btn-sm btn-primary me-1">Edit</a>
                                    <div class="modal fade" id="editGallery{{ $gallery->id }}" tabindex="-1"
                                         aria-labelledby="editGalleryModalLabel{{ $gallery->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ratingModalLabel">Edit Gallery</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="my-2" method="POST"
                                                          action="{{ route('updateImage', ["id" => $gallery->id]) }}"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="col-12 mb-2">
                                                            <label for="video">Add Image</label>
                                                            <input type="file" class="form-control" id="image"
                                                                   name="image" accept="image/*"/>
                                                        </div>

                                                        <div class="col-12 mb-2">
                                                            <div class="form-group">
                                                                <label for="description">Description</label>
                                                                <textarea class="form-control" maxlength="30"
                                                                          name="description"
                                                                          id="description">{{ $gallery->description }}</textarea>
                                                                <span
                                                                    style="font-size: 12px; color: grey">Max characters: <span
                                                                        id="bioCount">30</span></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <button class="btn btn-custom" type="submit">Update Image
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{ route('deleteImage', ["id" => $gallery->id]) }}"
                                       class="btn btn-sm btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="nav-video-tab" tabindex="0">
            @if($user->videos->count() < 2)
                <form class="mt-5" method="POST" action="{{ route('insertVideo') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-5 mb-2">
                        <label for="video">Add Video</label>
                        <input type="file" class="form-control" id="video" required name="video" accept="video/*"/>
                    </div>

                    <div class="col-5 mb-2">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" maxlength="30" name="description"
                                      id="description"></textarea>
                            <span style="font-size: 12px; color: grey">Max characters: <span
                                    id="bioCount">30</span></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-custom" type="submit">Add Video</button>
                    </div>
                </form>
            @endif

            <div class="row mb-4 mt-5">
                @foreach($user->videos as $video)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            <div style="width: 100%; height: 220px;">
                                <video class="card-img-top"
                                       style="width: 100%; height: 100%; object-fit: contain; object-position: top;"
                                       controls src="{{ asset('storage/'.substr($video->video, 6)) }}"></video>
                            </div>
                            <div class="card-body">
                                <p class="card-text my-3">{{ $video->description }}</p>
                                <div class="mt-3">
                                    <a data-bs-toggle="modal" data-bs-target="#editVideo{{ $video->id }}"
                                       class="btn btn-sm btn-primary me-1">Edit</a>
                                    <div class="modal fade" id="editVideo{{ $video->id }}" tabindex="-1"
                                         aria-labelledby="editVideoModalLabel{{ $gallery->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ratingModalLabel">Edit Video</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="my-2" method="POST"
                                                          action="{{ route('updateVideo', ["id" => $video->id]) }}"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="col-12 mb-2">
                                                            <label for="video">Add Video</label>
                                                            <input type="file" class="form-control" id="video"
                                                                   name="video" accept="video/*"/>
                                                        </div>

                                                        <div class="col-12 mb-2">
                                                            <div class="form-group">
                                                                <label for="description">Description</label>
                                                                <textarea class="form-control" maxlength="30"
                                                                          name="description"
                                                                          id="description">{{ $video->description }}</textarea>
                                                                <span
                                                                    style="font-size: 12px; color: grey">Max characters: <span
                                                                        id="bioCount">30</span></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <button class="btn btn-custom" type="submit">Update Video
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{ route('deleteVideo', ["id" => $video->id]) }}"
                                       class="btn btn-sm btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="tab-pane fade" id="urls" role="tabpanel" aria-labelledby="nav-url-tab" tabindex="0">
            <form class="my-5" method="POST" action="{{ route('insertUrl') }}">
                <div class="row">
                    @csrf
                    <div class="col-5 mb-2">
                        <label for="url">Url</label>
                        <input type="url" class="form-control" id="url" required name="url"
                               onkeyup="validateYouTubeUrl('url', 'submit')"/>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-custom" id="submit" type="submit">Add Url</button>
                </div>
            </form>

            <div class="row mb-4">
                @foreach($user->urls as $url)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            <div style="    width: 100%; height: 220px;">
                                <x-embed url="{{ $url->url }}"/>
                            </div>
                            <div class="card-body">
                                <div class="mt-3">
                                    <a data-bs-toggle="modal" data-bs-target="#editUrl{{ $url->id }}"
                                       class="btn btn-sm btn-primary me-1">Edit</a>
                                    <div class="modal fade" id="editUrl{{ $url->id }}" tabindex="-1"
                                         aria-labelledby="editUrlModalLabel{{ $url->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ratingModalLabel">Edit Url</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="my-2" method="POST"
                                                          action="{{ route('updateUrl', ["id" => $url->id]) }}">
                                                        @csrf
                                                        <div class="col-12 mb-2">
                                                            <label for="url1">Url</label>
                                                            <input type="url" class="form-control"
                                                                   id="url{{ $url->id }}" required
                                                                   name="url" value="{{ $url->url }}"
                                                                   onkeyup="validateYouTubeUrl('url{{ $url->id }}', 'submit{{ $url->id }}')"/>
                                                        </div>

                                                        <div class="form-group">
                                                            <button class="btn btn-custom" id="submit{{ $url->id }}"
                                                                    type="submit">
                                                                Update Url
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{ route('deleteUrl', ["id" => $url->id]) }}"
                                       class="btn btn-sm btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="tab-pane py-5 fade" id="changePassword" role="tabpanel" aria-labelledby="nav-password-tab"
             tabindex="0">
            <form class="form" action="{{ route('changePassword') }}" method="post" id="registrationForm">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" name="current_password" id="current_password"
                               placeholder="Current Password" required/>
                    </div>

                    <div class="col-3">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                               placeholder="New Password" required/>
                    </div>

                    <div class="col-3">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" class="form-control" name="password_confirmation"
                               id="password_confirmation" placeholder="Confirm New Passowrd" required/>
                    </div>

                    <div class="col-2">
                        <button class="btn btn-sm btn-custom mt-3" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div><!--/row-->

@include("frontend.layout.footer")

<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short text-white"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('frontend/vendor/aos/aos.js') }}"></script>
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
    class CustomSelect {
        constructor(originalSelect) {
            this.originalSelect = originalSelect;
            this.customSelect = document.createElement("div");
            this.customSelect.classList.add("select");

            this.originalSelect.querySelectorAll("option").forEach((optionElement) => {
                const itemElement = document.createElement("div");

                itemElement.classList.add("select__item");
                itemElement.textContent = optionElement.textContent;
                this.customSelect.appendChild(itemElement);

                if (optionElement.selected) {
                    this._select(itemElement);
                }

                itemElement.addEventListener("click", () => {
                    if (
                        this.originalSelect.multiple &&
                        itemElement.classList.contains("select__item--selected")
                    ) {
                        this._deselect(itemElement);
                    } else {
                        this._select(itemElement);
                    }
                });
            });

            this.originalSelect.insertAdjacentElement("afterend", this.customSelect);
            this.originalSelect.style.display = "none";
        }

        _select(itemElement) {
            const index = Array.from(this.customSelect.children).indexOf(itemElement);

            if (!this.originalSelect.multiple) {
                this.customSelect.querySelectorAll(".select__item").forEach((el) => {
                    el.classList.remove("select__item--selected");
                });
            }

            this.originalSelect.querySelectorAll("option")[index].selected = true;
            itemElement.classList.add("select__item--selected");
        }

        _deselect(itemElement) {
            const index = Array.from(this.customSelect.children).indexOf(itemElement);

            this.originalSelect.querySelectorAll("option")[index].selected = false;
            itemElement.classList.remove("select__item--selected");
        }
    }

    document.querySelectorAll(".custom-select").forEach((selectElement) => {
        new CustomSelect(selectElement);
    });

    document.addEventListener('DOMContentLoaded', function () {
        var gender = "{{ $user->gender }}";
        if (gender === "Male") {
            $('#maleNominations').show();
            $('#femaleNominations').hide();
        } else if (gender === "Female") {
            $('#maleNominations').hide();
            $('#femaleNominations').show();
        }
    }, false);

    function genderChange(event) {
        if (event.value === "Male") {
            $('#maleNominations').show();
            $('#femaleNominations').hide();
        } else if (event.value === "Female") {
            $('#maleNominations').hide();
            $('#femaleNominations').show();
        }
    }

    $(document).ready(function () {
        var readURL = function (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload").on('change', function () {
            readURL(this);
        });
    });

    var hash = location.hash.replace(/^#/, '');  // ^ means starting, meaning only match the first hash
    if (hash === "profile") {
        $('#nav-profile-tab').click();
    } else if (hash === "images") {
        $('#nav-image-tab').click();
    } else if (hash === "videos") {
        $('#nav-video-tab').click();
    } else if (hash === "urls") {
        $('#nav-url-tab').click();
    } else if (hash === "changePassword") {
        $('#nav-password-tab').click();
    }
</script>
<script>
    class ZodiacSign {
        static signs = {
            en: ["Aries", "Taurus", "Gemini", "Cancer", "Leo", "Virgo", "Libra", "Scorpio", "Sagittarius", "Capricorn", "Aquarius", "Pisces"],
            fr: ["Bélier", "Taureau", "Gémeaux", "Cancer", "Lion", "Vierge", "Balance", "Scorpion", "Sagittaire", "Capricorne", "Vereau", "Poissons"],
            es: ["Aries", "Tauro", "Géminis", "Cáncer", "Leo", "Virgo", "Libra", "Escorpio", "Sagitario", "Capricornio", "Acuario", "Piscis"],
            ar: ["الحمل", "الثور", "الجوزاء", "السرطان", "الأسد", "العذراء", "الميزان", "العقرب", " القوس", "الجدي", "الدلو", "الحوت"]
        };
        static chineseSigns = {
            en: ["Monkey", "Rooster", "Dog", "Pig", "Rat", "Ox", "Tiger", "Rabbit", "Dragon", "Snake", "Horse", "Sheep"],
            fr: ["Singe", "Coq", "Chien", "Cochon", "Rat", "Bœuf", "Tigre", "Lapin", "Dragon", "Serpent", "Cheval", "Mouton"],
            es: ["Mono", "Gallo", "Perro", "Cerdo", "Rata", "Buey", "Tigre", "Conejo", "Dragón", "Serpiente", "Caballo", "Oveja"],
            ar: ["القرد", "الديك", "الكلب", "الخنزير", "الفأر", "الثور", "النمر", "الأرنب", "التنين", "الثعبان", "الحصان", "الخروف"]
        };
        static chineseElements = {
            en: ["Metal", "Water", "Wood", "Fire", "Earth"],
            fr: ["Métal", "Eau", "Bois", "Feu", "Terre"],
            es: ["Metal", "Agua", "Madera", "Fuego", "Tierra"],
            ar: ["المعدني", "المائي", "الخشبي", "الناري", "الأرضي"]
        };

        constructor(e, i = "en") {
            this.sign = "", this.chinese = "", Object.hasOwn(ZodiacSign.signs, i) || (i = "en"), isNaN(Date.parse(e)) || (this.sign = this.#e(e, i), this.chinese = this.#i(e, i))
        }

        #e(e, i) {
            return ZodiacSign.signs[i][Number(new Intl.DateTimeFormat("fr-TN-u-ca-persian", {month: "numeric"}).format(Date.parse(e))) - 1]
        }

        #i(e, i) {
            let a = new Intl.DateTimeFormat("fr-TN-u-ca-chinese", {
                day: "2-digit",
                month: "long",
                year: "numeric"
            }).format(Date.parse(e)).substring(0, 4);
            return `${ZodiacSign.chineseElements[i][Math.floor(+a.charAt(3) / 2)]} ${ZodiacSign.chineseSigns[i][+a % 12]}`
        }
    }
</script>
<script>
    $(document).ready(function () {
        $("#filterDropdownToggle").click(function () {
            $("#filterDropdown").toggle();
        });
    });

    const getZodiacSign = (value) => {
        let zodiac = document.getElementById("zodiac").value = new ZodiacSign(value).sign;
    }
    // ========== Phone Number Validation ==========
    $("#valid_msg").hide();

    let phone_input = document.querySelector("#phone_no");
    let valid_msg = $("#valid_msg");
    let error_msg = $("#error_msg");

    @php
        $country = \Illuminate\Support\Facades\Auth::guard("web")->user()->country;
        $countryCode = \App\Models\Country::where("name", "=", $country)->first();
    @endphp

    let iti = window.intlTelInput(phone_input, {
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js",
        initialCountry: "{{ $countryCode->code }}",
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

    document.addEventListener('mouseup', function (e) {
        var container = document.getElementById('filterDropdown');
        if (!container.contains(e.target)) {
            container.style.display = 'none';
        }
    });

    function getImage(event) {
        let output = document.getElementById('avatar');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
    }

    function validateYouTubeUrl(id, btnID) {
        // var url = $('#' + id).val();
        // if (url != undefined || url != '') {
        //     $('#' + btnID).attr("disabled", "");
        //     var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
        //     var match = url.match(regExp);
        //     if (match && match[2].length == 11) {
        //         $('#' + btnID).removeAttr("disabled", "");
        //     } else {
        //         $('#' + btnID).attr("disabled", "");
        //     }
        // }
    }
</script>
</body>
</html>


