@extends("frontend.layout.app")
@section("title", "Search | ")

@section("styles")
    <style>
        .carousel-item img {
            height: 650px;
            object-fit: cover
        }
    </style>
@endsection

@section("section")
    @livewire('frontend.layout.header', compact('q', 'filter', 'gender', 'country'))

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

            <div class="col-xl-6 col-lg-6 justify-content-center mt-5 scrollContainer"
                 style="margin-bottom: 120px; height: 480px">

                <div class="text-center text-black mb-5">
                    @if($q != null)
                        <h5><strong>Showing results of '{{ $q }}'</strong></h5>
                    @endif

                    @if($filter != null)
                        @if($filter === "full_name")
                            <h5><strong>Showing results related to full name</strong></h5>
                        @elseif($filter === "username")
                            <h5><strong>Showing results related to username</strong></h5>
                        @elseif($filter === "email")
                            <h5><strong>Showing results related to email</strong></h5>
                        @elseif($filter === "nominations")
                            <h5><strong>Showing results related to nominations</strong></h5>
                        @endif
                    @endif

                    @if($gender != null)
                        <h5><strong>Showing results related to gender '{{ $gender }}'</strong></h5>
                    @endif

                    @if($country != null)
                        <h5><strong>Showing results related to country '{{ $country }}'</strong></h5>
                    @endif
                </div>

                <div class="row">
                    @if($searchUsers->count() != 0)
                        @foreach($searchUsers as $searchUser)
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6 col-6 mt-4">
                                <a href="{{ route("usersProfile", ["username" => $searchUser->username]) }}">
                                    <div class="d-flex">
                                        <img style="width: 50px; height: 50px; object-fit: cover;" class="rounded-5"
                                             src="{{ asset('storage/'.substr($searchUser->profile_photo, 6)) }}"
                                             onerror="this.src='https://via.placeholder.com/350x350.png';"
                                             alt="..."/>
                                        <div class="mx-1"></div>
                                        <div>
                                            <strong style="font-size: 12px">{{ $searchUser->full_name }}</strong>
                                            <br>
                                            <span style="font-size: 12px">{{ '@'.$searchUser->username }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 mt-3 text-center">
                            <p>No Users Found!</p>
                        </div>
                    @endif
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

