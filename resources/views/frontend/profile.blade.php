@extends("frontend.layout.app")
@section("title", "Profile | ")

@section("styles")
    <style>
        .carousel-item img {
            height: 900px;
            object-fit: cover
        }

        .star-rating, .back-stars, .front-stars {
            display: flex;
        }

        .star-rating {
            align-items: center;
            font-size: 32px;
            justify-content: center;
        }

        .back-stars {
            color: #c8c8c8;
            position: relative;
        }

        .front-stars {
            color: #982D28;
            overflow: hidden;
            position: absolute;
            top: 0;
            transition: all 0.5s;
        }

        .next-profile {
            background-color: dodgerblue;
            border-radius: 100%;
            color: #ffffff;
        }

        .next-profile:hover {
            background-color: #1374d2;
            color: #ffffff;
        }

        /* New One */
        .outer {
            display: grid;
            place-items: center;
            min-height: inherit;
        }

        .ratings-box {
            display: flex;
            gap: 10px;
        }

        .ratings-box__item label {
            position: relative;
            cursor: pointer;
            display: block;
        }

        .ratings-box__item label input {
            display: none;
            position: absolute;
        }

        .ratings-box {
            position: relative;
        }

        .ratings-box__item label span.rating-star {
            width: 30px;
            height: 30px;
            display: block;
            background: #982D28;
            position: relative;
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
        }

        .ratings-box__item label span.rating-star::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: white;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
        }

        .ratings-box:has(.ratings-box__item label input:checked) .ratings-box__item span.rating-star::after {
            transform: translate(-50%, -50%) scale(0);
        }

        .ratings-box__item:has(label > input:checked) ~ .ratings-box__item label .star-line-box span.rating-star::after {
            transform: translate(-50%, -50%) scale(1);
        }

        .rating-star-line {
            position: absolute;
            width: 4px;
            height: 10px;
            background: #982D28;
            display: block;
            opacity: 0;
        }

        .ratings-box__item input:checked ~ .star-line-box {
            animation: scaleAnim 0.4s linear;
            transform-origin: center;
        }

        @keyframes scaleAnim {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(0);
            }
        }

        .rating-star-line:nth-of-type(3), .rating-star-line:nth-of-type(2) {
            transform: rotate(45deg);
            right: 8px;
            bottom: 22px;
            transform-origin: bottom;
        }

        .rating-star-line:nth-of-type(3) {
            transform: rotate(-45deg);
            left: 7px;
        }

        .rating-star-line:nth-of-type(4) {
            transform: rotate(0deg);
            left: calc(50% - 1px);
            bottom: unset;
            top: 24px;
        }

        .ratings-box__item input:checked ~ .star-line-box .rating-star-line:nth-of-type(2) {
            animation: topLinesAnim 0.4s 0.3s linear;
        }

        .ratings-box__item input:checked ~ .star-line-box .rating-star-line:nth-of-type(3) {
            animation: topLinesAnim2 0.4s 0.3s linear;
        }

        .ratings-box__item input:checked ~ .star-line-box .rating-star-line:nth-of-type(4) {
            animation: bottomLineAnim 0.4s 0.3s linear;
        }

        @keyframes topLinesAnim {
            from {
                transform: rotate(45deg);
                opacity: 1;
            }
            to {
                transform: rotate(45deg) scaleY(1.2) translateY(-5px);
                opacity: 0;
            }
        }

        @keyframes topLinesAnim2 {
            from {
                transform: rotate(-45deg);
                opacity: 1;
            }
            to {
                transform: rotate(-45deg) scaleY(1.2) translateY(-5px);
                opacity: 0;
            }
        }

        @keyframes bottomLineAnim {
            from {
                transform: rotate(0);
                opacity: 1;
            }
            to {
                transform: rotate(0) scaleY(1.2) translateY(5px);
                opacity: 0;
            }
        }

    </style>
@endsection

@section("section")
    @livewire('frontend.layout.header')


    <section class="profile">
        <div class="row">
            <div class="col-xl-3 col-lg-3">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @if($leftSliders->count() != 0)
                            @foreach($leftSliders as $key => $leftSlider)
                                <div class="carousel-item {{ $key == 0 ? "active" : null }}">
                                    <img src="{{ asset('storage/'.substr($leftSlider->image, 6)) }}"
                                         class="d-block w-100" alt="...">
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
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 mt-5 mb-5 scrollContainer" style="height: 800px">
                <div class="row justify-content-between">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-sm-4">
                        <div style="width: 100%; height: 280px;">
                            <img style="width: 100%; height: 100%; object-fit: cover; object-position: top;"
                                 class="profilePic img-fluid"
                                 src="{{ asset('storage/'.substr($user->profile_photo, 6)) }}" alt="..."/>
                        </div>
                    </div>

                    <div class="col-xl-8 col-lg-8 col-md-8">
                        <div class="row text-center align-items-center">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-3 col-xs-6 col-6 mt-3">
                                <strong class="text-black">{{ $user->availableVote->total_voting }}</strong>
                                <br>
                                <strong class="text-secondary">Vote</strong>
                                <br>
{{--                                <img style="width: 36px; height: 36px" class="img-fluid"--}}
{{--                                     src="{{ asset('frontend/img/icons/vote.svg') }}" alt="..">--}}
                                @if(\Illuminate\Support\Facades\Auth::guard("web")->check())
                                    @if($user->userAction->voting === 0)
                                        <a href="{{ route('sendVotes', ["id" => $user->id]) }}">
                                            <img style="width: 36px; height: 36px" class="img-fluid"
                                                 src="{{ asset('frontend/img/icons/vote.svg') }}"
                                                 alt="..">
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" id="rate" data-toggle="tooltip"
                                           title="Your voting is blocked!">
                                            <img style="width: 36px; height: 36px" class="img-fluid"
                                                 src="{{ asset('frontend/img/icons/vote.svg') }}"
                                                 alt="..">
                                        </a>
                                    @endif
                                @else
                                    <img style="width: 36px; height: 36px" class="img-fluid"
                                         src="{{ asset('frontend/img/icons/vote.svg') }}" alt="..">
                                @endif
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-3 col-xs-6 col-6 mt-3">
                                <strong class="text-black">{{ $user->likes()->count() }}</strong>
                                <br>
                                <strong class="text-secondary">Likes</strong>
                                <br>
                                @if(\Illuminate\Support\Facades\Auth::guard("web")->check())
                                    @if($hasLiked === null)
                                        @if($liking->block === 0 && \Illuminate\Support\Facades\Auth::guard("web")->user()->userAction->liking === 0)
                                            <a href="{{ route("addLike", ["to" => $user->id]) }}">
                                                <img class="img-fluid" src="{{ asset('frontend/img/icons/like.svg') }}"
                                                     alt="..">
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" id="like" data-toggle="tooltip"
                                               title="Your liking is blocked!">
                                                <img class="img-fluid" src="{{ asset('frontend/img/icons/like.svg') }}"
                                                     alt="..">
                                            </a>
                                        @endif
                                    @else
                                        <a href="javascript:void(0)" id="like" data-toggle="tooltip"
                                           title="You have already liked the user!">
                                            <img class="img-fluid" src="{{ asset('frontend/img/icons/like.svg') }}"
                                                 alt="..">
                                        </a>
                                    @endif
                                @else
                                    <img class="img-fluid" src="{{ asset('frontend/img/icons/like.svg') }}"
                                         alt="..">
                                @endif
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-3 col-xs-6 col-6 mt-3">
                                <strong class="text-black">{{ $user->comments()->count() }}</strong>
                                <br>
                                <strong class="text-secondary">Comments</strong>
                                <br>
                                <a href="{{ route("comments", ["username" => $user->username]) }}">
                                    <img class="img-fluid" src="{{ asset('frontend/img/icons/chat.svg') }}" alt="..">
                                </a>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-3 col-xs-6 col-6 mt-3">
                                <strong class="text-black">{{ round($rating, 0) }}</strong>
                                <br>
                                <strong class="text-secondary">Rating</strong>
                                <br>
                                @if(\Illuminate\Support\Facades\Auth::guard("web")->check())
                                    @if($myRating === null)
                                        @if($rate->block === 0 && \Illuminate\Support\Facades\Auth::guard("web")->user()->userAction->rating === 0)
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#ratingModal">
                                                <div class="star-rating" title="{{ round(($rating / 5) * 100, 0) }}%">
                                                    <div class="back-stars">
                                                        <i class="fa fa-star" aria-hidden="true"></i>

                                                        <div class="front-stars"
                                                             style="width: {{ round(($rating / 5) * 100, 0) }}%">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="modal fade modal-sm" id="ratingModal" tabindex="-1"
                                                 aria-labelledby="ratingModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ratingModalLabel">Rating</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route("addRating", ["to" => $user->id]) }}"
                                                                  id="rating"
                                                                  method="post" class="rate" name="rating">
                                                                @csrf
                                                                <div class="outer">
                                                                    <div class="ratings-box">
                                                                        <div class="ratings-box__item">
                                                                            <label>
                                                                                <input id="rate-1"
                                                                                       class="rating-star-button"
                                                                                       onChange="autoSubmit();" required
                                                                                       value="1"
                                                                                       {{ $myRating ? ($myRating->rating == 1 ? "checked" : null) : null }}
                                                                                       type="radio" name="rating">
                                                                                <div class="star-line-box">
                                                                                    <span class="rating-star"></span>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                        <div class="ratings-box__item">
                                                                            <label>
                                                                                <input id="rate-2"
                                                                                       class="rating-star-button"
                                                                                       onChange="autoSubmit();" required
                                                                                       value="2"
                                                                                       {{ $myRating ? ($myRating->rating == 2 ? "checked" : null) : null }}
                                                                                       type="radio" name="rating">
                                                                                <div class="star-line-box">
                                                                                    <span class="rating-star"></span>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                        <div class="ratings-box__item">
                                                                            <label>
                                                                                <input id="rate-3"
                                                                                       class="rating-star-button"
                                                                                       onChange="autoSubmit();" required
                                                                                       value="3"
                                                                                       {{ $myRating ? ($myRating->rating == 3 ? "checked" : null) : null }}
                                                                                       type="radio" name="rating">
                                                                                <div class="star-line-box">
                                                                                    <span class="rating-star"></span>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                        <div class="ratings-box__item">
                                                                            <label>
                                                                                <input id="rate-4"
                                                                                       class="rating-star-button"
                                                                                       onChange="autoSubmit();" required
                                                                                       value="4"
                                                                                       {{ $myRating ? ($myRating->rating == 4 ? "checked" : null) : null }}
                                                                                       type="radio" name="rating">
                                                                                <div class="star-line-box">
                                                                                    <span class="rating-star"></span>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                        <div class="ratings-box__item">
                                                                            <label>
                                                                                <input id="rate-5"
                                                                                       class="rating-star-button"
                                                                                       onChange="autoSubmit();" required
                                                                                       value="5"
                                                                                       {{ $myRating ? ($myRating->rating == 5 ? "checked" : null) : null }}
                                                                                       type="radio" name="rating">
                                                                                <div class="star-line-box">
                                                                                    <span class="rating-star"></span>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <a href="javascript:void(0)" id="vote" data-toggle="tooltip"
                                               title="Your voting is blocked!">
                                                <div class="star-rating" title="{{ round(($rating / 5) * 100, 0) }}%">
                                                    <div class="back-stars">
                                                        <i class="fa fa-star" aria-hidden="true"></i>

                                                        <div class="front-stars"
                                                             style="width: {{ round(($rating / 5) * 100, 0) }}%">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                    @else
                                        <a href="javascript:void(0)" id="vote" data-toggle="tooltip"
                                           title="You have already rated the user!">
                                            <div class="star-rating" title="{{ round(($rating / 5) * 100, 0) }}%">
                                                <div class="back-stars">
                                                    <i class="fa fa-star" aria-hidden="true"></i>

                                                    <div class="front-stars"
                                                         style="width: {{ round(($rating / 5) * 100, 0) }}%">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endif

                                @else
                                    <div class="star-rating" title="{{ round(($rating / 5) * 100, 0) }}%">
                                        <div class="back-stars">
                                            <i class="fa fa-star" aria-hidden="true"></i>

                                            <div class="front-stars"
                                                 style="width: {{ round(($rating / 5) * 100, 0) }}%">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="row mt-2">
                            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-xs-7 col-7">
                                <strong>{{ $user->full_name }}</strong><br>
                                <p>{{ '@'.$user->username }}</p>
                            </div>

                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-xs-5 col-5">
                                <div class="align-items-center">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>{{ $user->country }}</span>
                                    <div class="">
                                        @if($previousUser != null)
                                            <a class="next-profile" style="margin-right: 5px; padding: 2px 6px"
                                               href="{{ route("usersProfile", ["username" => $previousUser->username]) }}">
                                                <i class="fa-solid fa-chevron-left"></i>
                                            </a>
                                        @else
                                            <a class="next-profile" style="margin-right: 5px; padding: 2px 6px" href="#">
                                                <i class="fa-solid fa-chevron-left"></i>
                                            </a>
                                        @endif

                                        @if($nextUser != null)
                                            <a class="next-profile" style="padding: 2px 7px"
                                               href="{{ route("usersProfile", ["username" => $nextUser->username]) }}">
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </a>
                                        @else
                                            <a class="next-profile" style="padding: 2px 7px" href="#">
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-sm-2">
                            <strong>Bio</strong><br>
                            <p>{{ $user->bio }}</p>
                        </div>

                    </div>
                </div>

                <div class="mt-4">
                    <h5><strong>Zodiac</strong></h5>

                    <div class="d-flex flex-wrap mt-2">
                        <p>{{ $user->zodiac }}</p>
                    </div>
                </div>

                <div class="mt-2">
                    <h5><strong>Hobbies</strong></h5>

                    <div class="d-flex flex-wrap mt-2">
                        <p>{{ $user->hobbies }}</p>
                    </div>
                </div>

                <div class="mt-2">
                    <h5><strong>Nominations</strong></h5>

                    <div class="d-flex flex-wrap mt-2">
                        @foreach($user->nominations as $nomination)
                            <div class="px-4 py-2 bg-danger text-white rounded-3"
                                 style="margin-right: 10px; margin-top: 10px">
                                <span>{{ $nomination->nomination->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 mt-5 pb-2">
                        <h5><strong>Photos</strong></h5>

                        <div class="row" style="--bs-gutter-x: 0.15rem">
                            @foreach($user->galleries as $gallery)
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12" style="margin-top: 0.15rem">
                                    <a href="{{ asset('storage/'.substr($gallery->image, 6)) }}" data-lightbox="image-1"
                                       data-title="{{ $gallery->description }}">
                                        <img
                                            style="height: 220px; flex-shrink: 0; min-width: 100%; object-fit: cover; object-position: top;"
                                            class="img-fluid" onerror="this.src='https://via.placeholder.com/350x350.png';"
                                            src="{{ asset('storage/'.substr($gallery->image, 6)) }}" alt="..."/>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 mt-5">
                        <h5><strong>Videos</strong></h5>

                        <div class="row" style="--bs-gutter-x: 0.15rem">
                            @foreach($user->videos as $video)
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <video style="height: 190px; flex-shrink: 0; width: 100%; object-fit: contain;"
                                           controls
                                           src="{{ asset('storage/'.substr($video->video, 6)) }}"></video>
                                    <p class="mt-3">{{ substr($video->description, 0, 25) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 mt-5">
                        <h5><strong>Urls</strong></h5>

                        <div class="row" style="--bs-gutter-x: 0.15rem">
                            @foreach($user->urls as $url)
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 pb-2">
                                    <x-embed style="flex-shrink: 0; width: 100%; object-fit: cover" url="{{ $url->url }}"/>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-4 justify-content-between">
                        <h5><strong>Share Profile</strong></h5>

                        <div class="">
                            <a href="javascript:void(0)"
                               onclick="shareOnFacebook('{{ request()->getHttpHost() . '/share_profile/' . $user->username }}')">
                                <i style="color: #3b5998" class="fa-brands fa-square-facebook h2"></i>
                            </a>
                            <a href="javascript:void(0)"
                               onclick="shareOnTwitter('{{ request()->getHttpHost() . '/share_profile/' . $user->username }}')">
                                <i style="color: #00acee" class="fa-brands fa-square-twitter h2"></i>
                            </a>
                            <a href="javascript:void(0)"
                               onclick="shareOnLinkedin('{{ request()->getHttpHost() . '/share_profile/' . $user->username }}')">
                                <i style="color: #0072b1" class="fa-brands fa-linkedin h2"></i>
                            </a>
                            <a href="javascript:void(0)"
                               onclick="shareOnWhatsApp('{{ request()->getHttpHost() . '/share_profile/' . $user->username }}')">
                                <i style="color: #075e54" class="fa-brands fa-whatsapp-square h2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @if($rightSliders->count() != 0)
                            @foreach($rightSliders as $key => $rightSlider)
                                <div class="carousel-item {{ $key == 0 ? "active" : null }}">
                                    <img src="{{ asset('storage/'.substr($rightSlider->image, 6)) }}"
                                         class="d-block w-100" alt="...">
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
                </div>
            </div>
        </div>
    </section>
@endsection

@section("scripts")
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'alwaysShowNavOnTouchDevices': true,
        })

        function autoSubmit() {
            let formObject = document.forms['rating'];
            formObject.submit();
        }

        $('#rate').tooltip()
        $('#like').tooltip()
        $('#vote').tooltip()
    </script>
@endsection
