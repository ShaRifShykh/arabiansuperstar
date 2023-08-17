@extends("frontend.layout.app")
@section("title", "Reset Password | ")

@section("section")
    <!-- ======= Header ======= -->
    <header class="text-center mt-4">
        <a href="{{ route("home") }}">
            <img src="{{ asset('frontend/img/logo.png') }}" alt="..."/>
        </a>
    </header><!-- End Header -->

    <div class="container align-self-center d-flex justify-content-center"
         style="margin-top: 120px; margin-bottom: 120px;">

        <form method="post" action="{{ route('verifyCode', ["id" => $user->id]) }}">
            <p style="font-weight:bold; font-size:20px;">We have sent a</p>
            <p style="font-weight:bold ;font-size:20px ;margin-top:-25px ;">code to your email</p>
            <p style="margin-top:-15px ;font-size:12px ;">Please check your email</p>

            <div class="form-group mt-4">
                @csrf
                <label for="code" style="margin-top:15px ;">Code</label><br>
                <input type="number" id="code" name="code" class="form-control @error('code') is-invalid @enderror"
                       style="border-radius:8px; width:260px; padding: 8px;">
                @error('code')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            @if(session('error'))
                <div class="mt-4">
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ session('error') }}</strong>
                    </div>
                </div>
            @endif

            <button class="btn btn-custom mt-4"
                    style="padding: 7px 110px;" type="submit">Next
            </button>
        </form>
    </div>
@endsection
