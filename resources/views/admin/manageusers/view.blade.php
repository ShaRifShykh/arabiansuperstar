@extends('admin.layout.app')
@section('title', 'Manage Users | ')

@section('content')
    <div class="content-wrapper" style="margin-left:0px !important">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.manageUser.list') }}">Manage Users</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-danger card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img
                                        class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('storage/'.substr($user->profile_photo, 6)) }}"
                                        alt="User profile picture"
                                    />
                                </div>
                                <h3 class="profile-username text-center">{{ $user->full_name }}</h3>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Vote</b> <a class="float-right">{{ $user->availableVote->votes_available }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Likes</b> <a class="float-right">{{ $user->likes()->count() }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Comments</b> <a class="float-right">{{ $user->comments()->count() }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Rating</b> <a class="float-right">{{ $rating }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>

                            <div class="card-body">
                                <strong><i class="fas fa-user mr-1"></i> Bio</strong>
                                <p class="text-muted">
                                    {{ $user->bio }}
                                </p>
                                <hr/>
                                <strong><i class="fas fa-book mr-1"></i> Hobbies</strong>
                                <p class="text-muted">
                                    {{ $user->hobbies }}
                                </p>
                                <hr/>
                                <strong
                                ><i class="fas fa-map-marker-alt mr-1"></i>
                                    Location</strong
                                >
                                <p class="text-muted">{{ $user->country }}</p>
                                <hr/>
                                <strong
                                ><i class="fas fa-phone mr-1"></i>
                                    Phone No</strong>
                                <p class="text-muted">+{{ $phoneCode ? $phoneCode->phonecode : null . ' ' . $user->phone_no }}</p>
                                <hr/>
                                <strong><i class="fas fa-genderless mr-1"></i> Gender</strong>
                                <p class="text-muted">
                                    {{ $user->gender }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#activity" data-toggle="tab">Activity</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#timeline" data-toggle="tab">Notifications</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#comments" data-toggle="tab">Comments</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#likes" data-toggle="tab">Likes</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#votes" data-toggle="tab">Votes</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <div class="post">
                                            <div class="row mb-3">
                                                @foreach($user->galleries as $gallery)
                                                    <div class="col-sm-4">
                                                        <img
                                                            class="img-thumbnail"
                                                            src="{{ asset('storage/'.substr($gallery->image, 6)) }}"
                                                            alt="Photo"
                                                        />
                                                        <p class="mt-2">{{ $gallery->description }}</p>
                                                        <div>
                                                            <a href="{{ route('admin.manageUser.editImage', ["id" => $gallery->id]) }}"
                                                               class="btn btn-sm btn-custom">Edit</a>
                                                            <a href="{{ route('admin.manageUser.deleteImage', ["id" => $gallery->id]) }}"
                                                               class="btn btn-sm btn-custom">Delete</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="row mb-3">
                                                @foreach($user->videos as $video)
                                                    <div class="col-sm-4">
                                                        <video width="280" height="210" controls
                                                               src="{{ asset('storage/'.substr($video->video, 6)) }}"></video>
                                                        <p class="mt-2">{{ $video->description }}</p>
                                                        <div>
                                                            <a href="{{ route('admin.manageUser.editVideo', ["id" => $video->id]) }}"
                                                               class="btn btn-sm btn-custom">Edit</a>
                                                            <a href="{{ route('admin.manageUser.deleteVideo', ["id" => $video->id]) }}"
                                                               class="btn btn-sm btn-custom">Delete</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach($user->urls as $url)
                                                        <div class="col-sm-4">
                                                            <x-embed url="{{ $url->url }}" />
                                                            <div>
                                                                <a href="{{ route('admin.manageUser.editUrl', ["id" => $url->id]) }}"
                                                                   class="btn btn-sm btn-custom">Edit</a>
                                                                <a href="{{ route('admin.manageUser.deleteUrl', ["id" => $url->id]) }}"
                                                                   class="btn btn-sm btn-custom">Delete</a>
                                                            </div>
                                                        </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="timeline">
                                        @foreach($notifications as $notification)
                                            @if($notification->comment_id != null)
                                                <div class="d-flex mt-4">
                                                    <img style="width: 50px; height: 50px;" class="rounded-5"
                                                         src="{{ asset('storage/'.substr($notification->comment->commentBY->profile_photo, 6)) }}"
                                                         alt="..."/>
                                                    <div class="mx-2"></div>
                                                    <div>
                                                        <strong>{{ $notification->comment->commentBY->full_name }}</strong>
                                                        <br>
                                                        <span><strong>Comment</strong> on your profile.</span>
                                                        <br>
                                                        <span
                                                            style="font-size: 12px">{{ $notification->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                                <hr>
                                            @elseif($notification->like_id != null)
                                                <div class="d-flex mt-4">
                                                    <img style="width: 50px; height: 50px;" class="rounded-5"
                                                         src="{{ asset('storage/'.substr($notification->like->likeBY->profile_photo, 6)) }}"
                                                         alt="..."/>
                                                    <div class="mx-2"></div>
                                                    <div>
                                                        <strong>{{ $notification->like->likeBY->full_name }}</strong>
                                                        <br>
                                                        <span><strong>Like</strong> on your profile.</span>
                                                        <br>
                                                        <span
                                                            style="font-size: 12px">{{ $notification->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                                <hr>
                                            @elseif($notification->rating_id != null)
                                                <div class="d-flex mt-4">
                                                    <img style="width: 50px; height: 50px;" class="rounded-5"
                                                         src="{{ asset('storage/'.substr($notification->rating->ratingBY->profile_photo, 6)) }}"
                                                         alt="..."/>
                                                    <div class="mx-2"></div>
                                                    <div>
                                                        <strong>{{ $notification->rating->ratingBY->full_name }}</strong>
                                                        <br>
                                                        <span>Give {{ $notification->rating->rating }} stars rating on your profile.</span>
                                                        <br>
                                                        <span
                                                            style="font-size: 12px">{{ $notification->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                                <hr>
                                            @elseif($notification->vote_by_id != null)
                                                <div class="d-flex mt-4">
                                                    <img style="width: 50px; height: 50px;" class="rounded-5"
                                                         src="{{ asset('storage/'.substr($notification->voteBy->voteBY->profile_photo, 6)) }}"
                                                         alt="..."/>
                                                    <div class="mx-2"></div>
                                                    <div>
                                                        <strong>{{ $notification->voteBy->voteBY->full_name }}</strong>
                                                        <br>
                                                        <span><strong>Vote</strong> on your profile.</span>
                                                        <br>
                                                        <span
                                                            style="font-size: 12px">{{ $notification->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                                <hr>
                                            @elseif($notification->message != null)
                                                <div class="mt-4">
                                                    <div>
                                                        <span>{{ $notification->message }}</span>
                                                        <br>
                                                        <span
                                                            style="font-size: 12px">{{ $notification->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="tab-pane" id="comments">
                                        @foreach($user->comments as $comment)
                                            <div class="d-flex mt-4">
                                                <a href="{{ route("usersShareProfile", ["username" => $user->username]) }}">
                                                    <img style="width: 50px; height: 50px;" class="rounded-5"
                                                         src="{{ asset('storage/'.substr($comment->commentBY->profile_photo, 6)) }}"
                                                         alt="..."/>
                                                </a>
                                                <div class="mx-2"></div>
                                                <div>
                                                    <a href="{{ route("usersShareProfile", ["username" => $user->username]) }}">
                                                        <strong>{{ $comment->commentBY->full_name  }}</strong>
                                                    </a>
                                                    <br>
                                                    <span>{{ $comment->comment }}</span>
                                                    <br>
                                                    <span
                                                        style="font-size: 12px">{{ \Illuminate\Support\Carbon::parse($comment->created_at)->format("d M Y g:i A") }}</span>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    </div>

                                    <div class="tab-pane" id="likes">
                                        @foreach($user->likes as $like)
                                            <div class="d-flex mt-4">
                                                <a href="{{ route("usersShareProfile", ["username" => $user->username]) }}">
                                                    <img style="width: 50px; height: 50px;" class="rounded-5"
                                                         src="{{ asset('storage/'.substr($like->likeBY->profile_photo, 6)) }}"
                                                         alt="..."/>
                                                </a>
                                                <div class="mx-2"></div>
                                                <div>
                                                    <a href="{{ route("usersShareProfile", ["username" => $user->username]) }}">
                                                        <strong>{{ $like->likeBY->full_name  }}</strong>
                                                    </a>
                                                    <br>
                                                    <span
                                                        style="font-size: 12px">{{ \Illuminate\Support\Carbon::parse($like->created_at)->format("d M Y g:i A") }}</span>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    </div>

                                    <div class="tab-pane" id="votes">
                                        <div>
                                            <div>
                                                <h3>Give Votes</h3>
                                                <form class="mt-3" method="POST"
                                                      action="{{ route('admin.manageUser.giveVote', ["id" => $user->id]) }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="votes">Give Votes</label>
                                                        <input type="number" class="form-control" id="votes"
                                                               name="votes"
                                                               placeholder="Give Votes">
                                                    </div>

                                                    <div class="d-grid mt-3">
                                                        <button type="submit" class="btn btn-block btn-custom">Give
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="mt-5">
                                                <h3>Take Votes</h3>
                                                <form class="mt-3" method="POST"
                                                      action="{{ route('admin.manageUser.takeVote', ["id" => $user->id]) }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="votes">Take Votes</label>
                                                        <input type="number" class="form-control" id="votes"
                                                               name="votes" max="{{ $user->availableVote->votes_available }}"
                                                               placeholder="Give Votes">
                                                    </div>

                                                    <div class="d-grid mt-3">
                                                        <button type="submit" class="btn btn-block btn-custom">Take
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
