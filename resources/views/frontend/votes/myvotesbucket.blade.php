@extends("frontend.layout.app")
@section("title", "My Votes Bucket | ")

@section("section")
    @livewire('frontend.layout.header')

    <div class="container align-self-center d-flex justify-content-center"
         style="margin-top: 180px; margin-bottom: 120px;">

        <div class="d-sm-flex flex-sm-wrap">
            <div>
                <img style="width: 250px; height: 300px; border-radius: 20px; object-fit: cover" class="img-fluid"
                     src="{{ asset('storage/'.substr($user->profile_photo, 6)) }}" alt="...">
            </div>

            <div class="mx-3"></div>

            <div class="mt-4">
                <div class="d-flex flex-wrap justify-content-between">
                    <div>
                        <strong>{{ $user->full_name }}</strong><br>
                        <p>{{ '@' . $user->username }}</p>
                    </div>

                    <div class="mx-5"></div>

                    <div class="mb-4">
                        <span class="material-symbols-outlined">location_on</span>
                        <span>{{ $user->country }}</span>
                    </div>
                </div>

                <div class="mb-3 mt-2 d-flex">
                    <span class="material-symbols-outlined h1">how_to_vote</span>
                    <div style="margin-right: 10px">
                    </div>
                    <div>
                        <span><strong>{{ \Illuminate\Support\Facades\Auth::guard("web")->user()->availableVote->total_voting }} Profile Votes</strong></span><br>
                        <span><strong>{{ \Illuminate\Support\Facades\Auth::guard("web")->user()->availableVote->votes_available }} Available Votes</strong></span><br>
                        <span>-----------------</span><br>
                        <span><strong>{{ \Illuminate\Support\Facades\Auth::guard("web")->user()->availableVote->votes_available + \Illuminate\Support\Facades\Auth::guard("web")->user()->availableVote->total_voting }} Total Votes</strong></span>
                    </div>
                </div>

                <div>
                    <a href="{{ route('buyVotesView') }}" class="btn btn-custom mt-4">Buy Votes</a>
                </div>
            </div>
        </div>
    </div>
@endsection
