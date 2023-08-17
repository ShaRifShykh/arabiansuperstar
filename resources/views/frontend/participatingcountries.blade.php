@extends("frontend.layout.app")
@section("title", "Participating Countries | ")

@section("section")
    @livewire('frontend.layout.header')

    <section id="section"
             style="background: url('{{ $data->banner != null ? asset('storage/'.substr($data->banner, 6)) :  asset('frontend/img/banners/participating_countries_banner.jpg') }}') top center no-repeat;"
             class="d-flex align-items-center container center">
        <div class="container">
            <div class="row">
                <div class="text-white col-lg-12 col-md-12 col-sm-12 text-center">
                    <h1 class="fw-bolder">{{$data->heading ? strtoupper($data->heading) : 'PARTICIPATING COUNTRIES'}}</h1>
                    <p class="text-white">{!! $data->sub_heading !!}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container" style="padding: 60px 90px 150px 90px;">
        <div class="row">

            @foreach($countries as $country)
                <div class="col-xl-2 col-lg-2 col-3 text-center mb-3">
                    <img style="filter: drop-shadow(0 0 0.25rem black);" class="img-fluid" src="{{ asset('storage/'.substr($country->flag, 6)) }}" alt="..."/>
                    <p class="mt-2">{{ ucfirst($country->name) }}</p>
                </div>
            @endforeach

        </div>
    </div>
@endsection

