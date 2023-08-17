@extends("frontend.layout.app")
@section("title", "Prize | ")

@section("styles")
    <style>
        tr {
            border-bottom-width: 0 !important;
        }
    </style>
@endsection

@section("section")
    @livewire('frontend.layout.header')


    <section id="section"
             style="background: url('{{ $data->banner != null ? asset('storage/'.substr($data->banner, 6)) : asset('frontend/img/banners/award_winner_banner.jpg') }}') top center no-repeat;"
             class="d-flex align-items-center container center">
        <div class="container">
            <div class="row">
                <div class="text-white col-lg-12 col-md-12 col-sm-12 text-center">
                    <h1 class="fw-bolder">{{ $data->heading ? strtoupper($data->heading) : "PRIZES & AWARD WINNER" }}</h1>
                    <p class="text-white">{!! $data->sub_heading !!}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-5 mb-5 pt-5 pb-5">
        <div class="row">
            @if($data->content)
                {!! $data->content !!}
            @else
                <div class="col-xl-6 col-lg-6">
                    <p>Prizes will be awarded to winners</p>
                    <p>1 year of potential media coverage across the region</p>
                    <p>Photography and fashion photo shoot as New Title Holder</p>
                    <p>New Face for the Arabian Superstar merchandise and advertising</p>
                    <p>Winners will be featured in Arabian Superstar YouTube channel</p>
                    <p>Professional photo session for all participants</p>
                    <p>Certificate of participation and Goody bag</p>
                    <p>End-less advertisement opportunities</p>
                    <p>Feature in YouTube channel</p>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <p>ARABIAN SUPERTAR trophy for the winner</p>
                    <p>Travel opportunities as the winner and New Title Holder</p>
                    <p>1 year as your country's ambassador representing your country</p>
                    <p>1 year as the primary model for the Arabian Superstar production</p>
                    <p>Opportunity to attend regional events as Guest of Honor</p>
                    <p>Celebrity Status with endless opportunities</p>
                    <p>Opportunity for Films, TV, Music Videos</p>
                    <p>Comprehensive media coverage</p>
                    <p>Feature in press releases</p>
                </div>
            @endif

        </div>
    </div>
@endsection

