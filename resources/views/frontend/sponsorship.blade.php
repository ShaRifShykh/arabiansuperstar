@extends("frontend.layout.app")
@section("title", "Sponsorship | ")

@section("styles")
    <style>
        .divarabim1 {
            min-height: 200px;
            background-size: cover;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .divarabpara {
            color: white;
            text-align: center;
            padding: 10px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .divarabpara p {
            font-size: 13px;
        }

        .divarabpara h5 {
            font-size: 19px;
            font-weight: bolder;
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
                    <h1 class="fw-bolder">{{$data->heading ? strtoupper($data->heading) : 'SPONSORSHIP'}}</h1>
                    <p class="text-white">{!! $data->sub_heading !!}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container pt-5 mb-5">
        <div class="row no-gutter">
            @foreach($associates as $associate)
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="divarabim1"
                         style="background: url('{{ asset('storage/'.substr($associate->bg_image, 6)) }}') top center no-repeat;">
                        <div class="divarabpara">
                            <h5>{{ $associate->heading }}</h5>
                            <br>
                            <p>{{ $associate->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

