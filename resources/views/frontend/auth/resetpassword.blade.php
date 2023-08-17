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


        <form method="POST" action="{{ route("newPassword") }}">
            <h5 style="font-weight: bold;">New Password</h5>
            <h6 style="font-weight: bold;">Please Create New password</h6>

            @csrf
            <input type="number" name="id" value="{{ $user->id }}" hidden readonly>

            <div class="form-group mt-4">
                <label for="password" style="margin-top:15px ;">New Password</label><br>
                <div class="password" id="password">
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" id="password">
                    <div class="form-group-addon">
                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <label for="password_confirmation" style="margin-top:15px ;">New Password</label><br>
                <div class="password" id="password_confirmation">
                    <input type="password"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           name="password_confirmation" id="password_confirmation">
                    <div class="form-group-addon">
                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>

            <button class="btn-custom mt-4" type="submit"
                    style="padding: 7px 110px; border: none;">Change Password
            </button>
        </form>
    </div>
@endsection

@section("scripts")
    <script>
        $(document).ready(function() {
            $("#password_confirmation a").on('click', function(event) {
                event.preventDefault();
                if($('#password_confirmation input').attr("type") == "text"){
                    $('#password_confirmation input').attr('type', 'password');
                    $('#password_confirmation i').addClass( "fa-eye-slash" );
                    $('#password_confirmation i').removeClass( "fa-eye" );
                }else if($('#password_confirmation input').attr("type") == "password"){
                    $('#password_confirmation input').attr('type', 'text');
                    $('#password_confirmation i').removeClass( "fa-eye-slash" );
                    $('#password_confirmation i').addClass( "fa-eye" );
                }
            });

            $("#password a").on('click', function(event) {
                event.preventDefault();
                if($('#password input').attr("type") == "text"){
                    $('#password input').attr('type', 'password');
                    $('#password i').addClass( "fa-eye-slash" );
                    $('#password i').removeClass( "fa-eye" );
                }else if($('#password input').attr("type") == "password"){
                    $('#password input').attr('type', 'text');
                    $('#password i').removeClass( "fa-eye-slash" );
                    $('#password i').addClass( "fa-eye" );
                }
            });
        });
    </script>
@endsection
