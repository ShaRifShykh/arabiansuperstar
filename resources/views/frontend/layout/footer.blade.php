<style>
    .social-icons i {
        padding: 12px 12px 12px 12px;
        border: 1px solid gray;
        border-radius: 50%;
        margin: 2px;
        color: gray;
    }
</style>

@php
    use App\Models\AppSetting;
$instagram = AppSetting::where("key", "=", "instagram")->first() ?? null;
$twitter = AppSetting::where("key", "=", "twitter")->first() ?? null;
$youtube = AppSetting::where("key", "=", "youtube")->first() ?? null;
$snapchat = AppSetting::where("key", "=", "snapchat")->first() ?? null;
$pinterest = AppSetting::where("key", "=", "pinterest")->first() ?? null;
$linkedin = AppSetting::where("key", "=", "linkedin")->first() ?? null;
$facebook = AppSetting::where("key", "=", "facebook")->first() ?? null;
$google = AppSetting::where("key", "=", "google")->first() ?? null;
@endphp

<!-- ======= Footer ======= -->
<footer id="footer" style="background-color: #f7f7f7;">
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="d-md-flex justify-content-between text-center">
                    <div class="d-flex flex-wrap pl-2">
                        <p style="margin-left: 10px;color:#000"> <a href="{{ route("prize") }}"> Prizes</a></p>
                        <p style="margin-left: 10px;color:#000"> <a href="{{ route("judges") }}"> Judges</a></p>
                        <p style="margin-left: 10px;color:#000"> <a href="{{ route("hostCity") }}"> Host City</a></p>
                        <p style="margin-left: 10px;color:#000"> <a href="{{ route("association") }}"> Associates</a></p>
                        <p style="margin-left: 10px;color:#000"> <a href="{{ route("sponsorship") }}"> Sponsorship</a></p>
                        <p style="margin-left: 10px;color:#000"> <a href="{{ route("eventTicket") }}"> Event Tickets</a></p>
                    </div>

                    <div>
                        <img class="img-fluid" style="width: 120px;" src="{{ asset('frontend/img/appleplay.png') }}" alt="">
                        <img class="img-fluid" style="width: 120px;" src="{{ asset('frontend/img/googleplay.png') }}" alt="">
                    </div>
                </div>


                <hr style="color:#000">

                <div class="d-md-flex justify-content-between text-center">
                    <div class="d-flex flex-wrap pl-2">
                        <p style="margin-left: 10px;color:#000"> <a href="{{ route("faqs") }}"> FAQs</a></p>
                        <p style="margin-left: 10px;color:#000"> <a href="{{ route("howItWorks") }}"> How it Works</a></p>
                        <p style="margin-left: 10px;color:#000"><a href="{{ route("eligibility") }}"> Eligibility</a></p>
                        <p style="margin-left: 10px;color:#000"><a href="{{ route("participatingCountries") }}"> Countries</a></p>
                        <p style="margin-left: 10px;color:#000"><a href="{{ route("contactUs") }}"> Contact Us</a></p>
                    </div>

                    <div class="text-black social-icons">
                        @if($facebook->value !== null)
                            <a href="{{ $facebook->value }}" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                        @endif
                        @if($youtube->value !== null)
                            <a href="{{ $youtube->value }}" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                        @endif
                        @if($twitter->value !== null)
                            <a href="{{ $twitter->value }}" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                        @endif
                        @if($linkedin->value !== null)
                            <a href="{{ $linkedin->value }}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                        @endif
                        @if($instagram->value !== null)
                            <a href="{{ $instagram->value }}" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        @endif
                        @if($pinterest->value !== null)
                            <a href="{{ $pinterest->value }}" target="_blank"><i class="fa-brands fa-pinterest-p"></i></a>
                        @endif
                        @if($google->value !== null)
                            <a href="{{ $google->value }}" target="_blank"><i class="fa-brands fa-google"></i></a>
                        @endif
                        @if($snapchat->value !== null)
                            <a href="{{ $snapchat->value }}" target="_blank"><i class="fa-brands fa-snapchat"></i></a>
                        @endif
                    </div>
                </div>


                <div class="d-md-flex justify-content-between mt-4 text-center">
                    <p style="color: #000000">Copyright © {{ \Illuminate\Support\Carbon::now()->year }} . All Rights Reserved</p>
                    <p><a href="{{ route("termsAndConditions") }}">Terms & Condition</a></p>
                </div>
            </div>
        </div>
    </div>
</footer><!-- End Footer -->
