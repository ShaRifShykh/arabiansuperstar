@extends("frontend.layout.app")
@section("title", $user->full_name . "'s Comments | ")

@section("styles")
    <style>
        .carousel-item img {
            height: 800px;
            object-fit: cover
        }

        .emojionearea {
            outline: none;
            border: none;
            box-shadow: none;
        }

        .emojionearea.focused {
            outline: none;
            border: none;
            box-shadow: none;
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

            <div class="col-xl-6 col-lg-6 d-flex justify-content-center justify-content-center mt-5 scrollContainer"
                 style="padding-bottom: 80px; height: 700px">

                <div style="width: 100%">
                    <div class="text-center text-black mb-5">
                        <h2><strong>Comments</strong></h2>
                    </div>

                    @foreach($user->comments as $comment)
                        <div class="d-flex mt-4">
                            <a href="{{ route("usersProfile", ["username" => $comment->commentBY->username]) }}">
                                <img style="width: 50px; height: 50px;" class="rounded-5"
                                     src="{{ asset('storage/'.substr($comment->commentBY->profile_photo, 6)) }}"
                                     alt="..."/>
                            </a>
                            <div class="mx-2"></div>
                            <div>
                                <a href="{{ route("usersProfile", ["username" => $comment->commentBY->username]) }}">
                                    <strong>{{ $comment->commentBY->full_name  }}</strong>
                                </a>
                                <br>
                                <span>{{ $comment->comment }}</span>
                                <br>
                                <span
                                    style="font-size: 12px">{{ \Illuminate\Support\Carbon::parse($comment->created_at)->format("d M Y g:i A") }}</span>
                            </div>
                        </div>
                    @endforeach

                    <div id="commentForm">
                        @if($action->block === 0 && \Illuminate\Support\Facades\Auth::guard("web")->user()->userAction->commenting === 0)
                            <form id="commentForm" action="{{ route("addComment", ["to" => $user->id]) }}"
                                  method="post"
                                  class="comment mt-5 d-flex">
                                @csrf
                                <input type="text" name="comment" id="comment" placeholder="Type a message..."
                                       required/>
                                <button id="submit" type="submit"><i class="fas fa-paper-plane"></i></button>
                            </form>
                        @else
                            <div class="mt-4 text-center">
                                <p><strong>Your commenting is blocked!</strong></p>
                            </div>
                        @endif
                    </div>
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

@section("scripts")
    <script>
        let i = 0;
        $(document).ready(function () {
            var emojiStandAlone = $("#comment").emojioneArea({
                inline: true,
                hidePickerOnBlur: true,
                autocomplete: false,
                events: {
                    keyup: function (editor, e) {
                        if (e.keyCode === 13) {
                            var text = $('#comment').data('emojioneArea').getText();
                            let comment = text;

                            if (comment !== '' && i === 0) {
                                ++i;

                                $.ajax({
                                    url: "{{ route("addComment", ["to" => $user->id]) }}",
                                    type: "post",
                                    data: {
                                        '_token': '{{ csrf_token() }}',
                                        "comment": comment
                                    },
                                    success: function (response) {
                                        location.reload();
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.log(textStatus, errorThrown);
                                    }
                                });
                            }
                        }
                    },
                }
            });
        });
    </script>
@endsection
