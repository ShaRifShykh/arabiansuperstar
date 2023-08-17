@extends("frontend.layout.app")
@section("title", "Notifications | ")

@section("styles")
    <style>
        .carousel-item img {
            height: 800px;
            object-fit: cover
        }
    </style>
@endsection

@section("section")
    @livewire('frontend.layout.header')

    <section class="profile">
        <div class="row">
            <div class="col-xl-3 col-lg-3 imgToFit">
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

            <div class="col-xl-6 col-lg-6 d-flex justify-content-center mt-5 scrollContainer"
                 style="margin-bottom: 120px; height: 630px">

                <div style="width: 100%">
                    <div class="text-center text-black mb-5">
                        <h2><strong>Notifications</strong></h2>
                    </div>

                    @foreach($notifications as $notification)
                        @if($notification->comment_id != null)
                            <div class="d-flex mt-4">
                                <a href="{{ route("usersProfile", ["username" => $notification->comment->commentBY->username]) }}">
                                    <img style="width: 50px; height: 50px;" class="rounded-5"
                                         src="{{ asset('storage/'.substr($notification->comment->commentBY->profile_photo, 6)) }}"
                                         alt="..."/>
                                </a>

                                <div class="mx-2"></div>
                                <div>
                                    <a href="{{ route("usersProfile", ["username" => $notification->comment->commentBY->username]) }}">
                                        <strong>{{ $notification->comment->commentBY->full_name }}</strong>
                                    </a>
                                    <br>
{{--                                    <a href="{{ route("comments", ["username" => $notification->comment->commentBY->username]) }}">--}}
{{--                                        <span><strong>Commented</strong> on your profile.</span>--}}
{{--                                    </a>--}}
                                    <span><strong>Commented</strong> on your profile.</span>
                                    <br>
                                    <span
                                        style="font-size: 12px">{{ \Illuminate\Support\Carbon::parse($notification->created_at)->format("d M Y g:i A") }}</span>
                                </div>
                            </div>
                            <hr>
                        @elseif($notification->like_id != null)
                            <div class="d-flex mt-4">
                                <a href="{{ route("usersProfile", ["username" => $notification->like->likeBY->username]) }}">
                                    <img style="width: 50px; height: 50px;" class="rounded-5"
                                         src="{{ asset('storage/'.substr($notification->like->likeBY->profile_photo, 6)) }}"
                                         alt="..."/>
                                </a>
                                <div class="mx-2"></div>
                                <div>
                                    <a href="{{ route("usersProfile", ["username" => $notification->like->likeBY->username]) }}">
                                        <strong>{{ $notification->like->likeBY->full_name }}</strong>
                                    </a>
                                    <br>
                                    <span><strong>Liked</strong> on your profile.</span>
                                    <br>
                                    <span
                                        style="font-size: 12px">{{ \Illuminate\Support\Carbon::parse($notification->created_at)->format("d M Y g:i A") }}</span>
                                </div>
                            </div>
                            <hr>
                        @elseif($notification->vote_by_id != null)
                            <div class="d-flex mt-4">
                                <a href="{{ route("usersProfile", ["username" => $notification->voteBy->voteBY->username]) }}">
                                    <img style="width: 50px; height: 50px;" class="rounded-5"
                                         src="{{ asset('storage/'.substr($notification->voteBy->voteBY->profile_photo, 6)) }}"
                                         alt="..."/>
                                </a>
                                <div class="mx-2"></div>
                                <div>
                                    <a href="{{ route("usersProfile", ["username" => $notification->voteBy->voteBY->username]) }}">
                                        <strong>{{ $notification->voteBy->voteBY->full_name }}</strong>
                                    </a>
                                    <br>
                                    <span><strong>Voted</strong> on your profile.</span>
                                    <br>
                                    <span
                                        style="font-size: 12px">{{ \Illuminate\Support\Carbon::parse($notification->created_at)->format("d M Y g:i A") }}</span>
                                </div>
                            </div>
                            <hr>
                        @elseif($notification->message != null)
                            <div class="mt-4">
                                <div>
                                    <span>{{ $notification->message }}</span>
                                    <br>
                                    <span
                                        style="font-size: 12px">{{ \Illuminate\Support\Carbon::parse($notification->created_at)->format("d M Y g:i A") }}</span>
                                </div>
                            </div>
                            <hr>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 imgToFit">
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
