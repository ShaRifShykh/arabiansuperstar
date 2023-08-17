@extends("frontend.layout.app")

@section("styles")
    <style>
        .carousel-item img {
            height: 900px;
            object-fit: cover
        }

        .owl-item {
            text-align: start;
        }

        .form-check-input {
            outline: 1px solid grey;
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

            <div class="col-xl-6 col-lg-6 align-items-center mt-4 mb-4 scrollContainer" style="height: 850px">
                <div class="mb-2">
                    <div class="text-center text-black">
                        <h2><strong>Top Contestant</strong></h2>
                    </div>

                    <div class="mt-5 align-items-center owl-carousel d-flex" id="carousel">
                        @foreach($users as $user)
                            <div class="d-flex align-self-center">
                                <a class="text-center"
                                   href="{{ route("usersProfile", ["username" => $user->username]) }}">
                                    <div
                                        style="width: 65px; height: 65px; border: 3px solid transparent; background: linear-gradient(white, white) padding-box, linear-gradient(to right, #E7C927, #B65426) border-box; border-radius: 100%; display: flex; justify-content: center; align-items: center">
                                        <img src="{{ asset('storage/'.substr($user->profile_photo, 6)) }}"
                                             class="rounded-5"
                                             onerror="this.src='https://via.placeholder.com/350x350.png';"
                                             style="width: 60px; height: 60px; object-fit: cover; padding: 2px"
                                             alt="..."/>
                                    </div>
                                    <p class="mt-1" style="font-size: 14px">{{ substr($user->username, 0, 6) }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="container-fluid mt-5 justify-items-center">
                    <div class="text-center text-black mb-2">
                        <h2><strong>Discover</strong></h2>
                    </div>

                    <div class="my-5 row px-5">
                        @foreach($feedUsers as $feedUser)
                            <div class="col-10 mb-4 mx-auto">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex mb-4">
                                            <div class="me-3" style="width: 50px; height: 50px;">
                                                <img
                                                    style="width: 100%; height: 100%; object-fit: cover; object-position: top;"
                                                    class="rounded-5"
                                                    onerror="this.src='https://via.placeholder.com/350x350.png';"
                                                    src="{{ asset('storage/'.substr($feedUser->profile_photo, 6)) }}"
                                                    alt="..."/>
                                            </div>
                                            <div>
                                                <a class="d-block"
                                                   href="{{ route("usersProfile", ["username" => $feedUser->username]) }}">
                                                    <strong>{{ $feedUser->full_name }}</strong>
                                                </a>
                                                <span>{{ $feedUser->country }}</span>
                                            </div>
                                        </div>

                                        <a href="{{ route("usersProfile", ["username" => $feedUser->username]) }}">
                                            <div style="height: 400px;">
                                                <img class="rounded-3"
                                                     style="width: 100%; height: 100%; object-fit: cover; object-position: top;"
                                                     onerror="this.src='https://via.placeholder.com/350x350.png';"
                                                     src="{{ asset('storage/'.substr($feedUser->galleries[0]->image, 6)) }}"
                                                     alt="..."/>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel({
                loop: true,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                margin: 10,
                nav: true,
                navContainer: '#carousel',
                navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                responsive: {
                    0: {
                        items: 5
                    },
                    600: {
                        items: 6
                    },
                    1000: {
                        items: 9
                    }
                }
            });
        });
    </script>
@endsection
