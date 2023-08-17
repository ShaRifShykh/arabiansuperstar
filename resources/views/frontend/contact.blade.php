@extends("frontend.layout.app")
@section("title", "Contact Us | ")

@section('styles')
    <style>
        .form-control {
            border: 1px solid rgb(83, 74, 74);
        }
        .form-control:focus {
            box-shadow: none;
            border: 1px solid red;
            outline: 0 none;
        }
    </style>
@endsection

@section("section")
    @livewire('frontend.layout.header')

    <section id="section"
             style="background: url('{{ $data->banner != null ? asset('storage/'.substr($data->banner, 6)) : asset('frontend/img/banners/association_banner.jpg') }}') top center no-repeat;"
             class="d-flex align-items-center container center">

        <div class="container">
            <div class="row">
                <div class="text-white col-lg-12  col-md-12 col-sm-12 text-center">
                    <h1 class="fw-bolder">{{$data->heading ? strtoupper($data->heading) : 'Contact Us'}}</h1>
                    <p class="text-white">{!! $data->sub_heading !!}</p>
                </div>
            </div>
        </div>

    </section>

    <div class="container mt-2 pt-5 pb-5 mb-5">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-2 col-sm-12 col-12"></div>
            <form method="POST" action="{{ route('contactUsSubmit') }}" class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12">
                @if(session('success'))
                    <div>
                        <div class="alert alert-success" role="alert">
                            <strong>{{ session('success') }}</strong>
                        </div>
                    </div>
                @endif
                @csrf
                <div class="form-group mt-5">
                    <label for="full_name">Full Name</label>
                    <input type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name"
                           value="{{ old('full_name') }}" id="full_name">
                    @error('full_name')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" id="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="phone_no">Phone No</label>
                    <br>
                    <input type="number" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no"
                           value="{{ old('phone_no') }}" id="phone_no">
                    @error('phone_no')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="message">Message</label>
                    <textarea class="form-control @error('message') is-invalid @enderror" name="message"
                              id="message" rows="6">{{ old('message') }}</textarea>
                    @error('message')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="d-grid mt-3">
                    <button id="submit" type="submit" class="btn btn-block btn-custom">Submit</button>
                </div>
            </form>
            <div class="col-xl-3 col-lg-3 col-md-2 col-sm-12 col-12"></div>
        </div>
    </div>
@endsection

