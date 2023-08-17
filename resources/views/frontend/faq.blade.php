@extends("frontend.layout.app")
@section("title", "FAQs | ")

@section("section")
    @livewire('frontend.layout.header')

    <!-- ======= Hero Section ======= -->
    <section id="section"
             style="background: url('{{ $data->banner != null ? asset('storage/'.substr($data->banner, 6)) :  asset('frontend/img/banners/faqs.jpg') }}') top center no-repeat; background-position: center;
                 background-size: cover;" class="d-flex align-items-center container center">
        <div class="container">
            <div class="row">
                <div class="text-white col-lg-12 col-md-12 col-sm-12 text-center">
                    <h1 class="fw-bolder">{{$data->heading ? strtoupper($data->heading) :'Frequently Asked Questions'}}</h1>
                    <p class="text-white">{!! $data->sub_heading !!}</p>
                </div>
            </div>
        </div>
    </section>


    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
        <div class="container">

            <ul class="faq-list accordion">

                @foreach($faqs as $faq)
                    <li>
                        <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq{{ $faq->id }}">{{ $faq->question }} <i class="bx bx-chevron-down icon-show"></i><i
                                class="bx bx-x icon-close"></i></a>
                        <div id="faq{{ $faq->id }}" class="collapse" data-bs-parent=".faq-list">
                            <p>{!! $faq->answer !!}</p>
                        </div>
                    </li>
                @endforeach

            </ul>

        </div>
    </section><!-- End Frequently Asked Questions Section -->
@endsection

