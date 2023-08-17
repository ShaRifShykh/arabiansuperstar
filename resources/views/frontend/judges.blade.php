@extends("frontend.layout.app")
@section("title", "Judges | ")

@section("styles")
    <style>
        .card {
            background: rgb(204, 45, 58);
            background: linear-gradient(180deg, rgba(204, 45, 58, 1) 0%, rgba(93, 47, 19, 1) 100%);
        }

        .card-body {
            padding: 45px;
            height: 200px;
            align-items: center;
            justify-content: center;
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
                    <h1 class="fw-bolder">{{ $data->heading ? strtoupper($data->heading) : 'JUDGES' }}</h1>
                    <p class="text-white">{!! $data->sub_heading !!}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= Frequently Asked Questions Section ======= -->
    <div class="container" style="margin-bottom:100px; margin-top:20px" data-aos="fade-up">
        <div class="row">
            @foreach($judges as $judge)
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12 mt-3">
                    <div class="card text-white text-center">
                        <div class="card-body">
                            <div class="p-3">
                                <img src="{{ asset('storage/'.substr($judge->icon, 6)) }}" alt="..."
                                     class="img-fluid" style="width: 30px; height: 28px; object-fit: 'cover';">
                            </div>
                            <p class="card-text">{{ $judge->heading }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

