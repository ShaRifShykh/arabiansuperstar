@extends("frontend.layout.app")
@section("title", "Terms & Conditions | ")

@section("section")
    @livewire('frontend.layout.header')


    <section id="section"
             style="background: url('{{ $data->banner != null ? asset('storage/'.substr($data->banner, 6)) : asset('frontend/img/banners/terms_and_conditions_banner.jpg') }}') top center no-repeat;"
             class="d-flex align-items-center container center">
        <div class="container">
            <div class="row">
                <div class="text-white col-lg-12 col-md-12 col-sm-12 text-center">
                    <h1 class="fw-bolder">{{$data->heading ? strtoupper($data->heading) : 'TERMS & CONDITIONS'}}</h1>
                    <p class="text-white">{!! $data->sub_heading !!}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container" style="padding: 60px 90px 150px 90px;">
        {!! $data->content !!}
    </div>
@endsection

