@extends("frontend.layout.app")
@section("title", "Host City | ")

@section("section")
    @livewire('frontend.layout.header')

    <!-- ======= Hero Section ======= -->
    <section id="section" style="background: url('{{ $data->banner != null ? asset('storage/'.substr($data->banner, 6)) : asset('frontend/img/banners/hostcity.jpg') }}') center center no-repeat; border-radius: 10px; background-size: cover;"
             class="d-flex align-items-center container center">
        <div class="container">
            <div class="row">
                <div class="text-white col-lg-12 col-md-12 col-sm-12 text-center">
                    <h1 class="fw-bolder">{{$data->heading ? strtoupper($data->heading) : 'HOST CITY'}}</h1>
                    <p class="text-white">{!! $data->sub_heading !!}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero -->

    <div class="container my-5">
        <div class="row">
            @foreach($hostCities as $hostCity)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div style="height: 250px">
                        <img src="{{ asset('storage/'.substr($hostCity->image, 6)) }}" class="img-fluid"
                             style="width: 100%; height: 100%; object-fit: cover; border-radius: 7px;" alt="...">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
