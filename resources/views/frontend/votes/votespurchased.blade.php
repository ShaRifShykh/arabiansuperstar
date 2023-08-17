@extends("frontend.layout.app")
@section("title", "Votes Purchased Successfully! | ")

@section("section")
    <div class="align-self-center justify-content-center"
         style="background: url('{{ asset('frontend/img/signup1.jpeg') }}');
          padding-top: 150px; padding-bottom: 150px; object-fit: cover;">
        <div style="margin-top: 100px">
            <h1 style="font-weight: bolder; color: #ffffff" class="text-center">Thank You!</h1>
            <h4 style="font-weight: bolder; color: #ffffff" class="text-center mb-5">Now, Welcome to our app!</h4>
            <div class="mt-2 text-center">
                <a class="btn btn-block btn-custom px-5" href="{{ route("myVotesBucket") }}">Next</a>
            </div>
        </div>
    </div>
@endsection
