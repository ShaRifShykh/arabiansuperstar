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

        <form method="post" action="{{ route('sendResetPasswordMail') }}">
            <p style="font-weight:bold ;font-size:20px ;">Reset Password</p>
            <p style="margin-top:-15px ;font-size:12px ;">Please enter your email to receive a link
                <br> to create a new password via email!
            </p>

            <div class="form-group mt-4">
                @csrf
                <label for="email" style="margin-top:15px ;">Enter your email address</label><br>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       style="border-radius:8px; width:260px; padding: 8px;">
                @error('email')
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

            <button class="btn btn-custom mt-5" type="submit"
                    style="padding: 7px 110px;">Next</button>
        </form>
    </div>
@endsection
