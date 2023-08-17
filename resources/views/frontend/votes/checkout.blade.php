@extends("frontend.layout.app")
@section("title", "Buy Votes | ")

@section("styles")
    <link rel="stylesheet" href="{{ asset('frontend/css/yearpicker.css') }}"/>

    <style>
        .form-control {
            border: none;
            background-color: #F4F5F7;
        }

        .form-control:focus {
            box-shadow: none;
            border: none;
            outline: 0 none;
            background-color: #F4F5F7;
        }
    </style>
@endsection

@section("section")
    @livewire('frontend.layout.header')

    <div class="align-self-center justify-content-center"
         style="margin: 130px 170px 120px;">

        <h2 style="font-weight: bolder" class="text-center mb-5">PAYMENT</h2>

        <form action="{{ route('buyVotes', ["id" => $votePlan->id]) }}" method="POST" class="row justify-content-center">
            @csrf
            <div class="col-xl-2"></div>
            <div class="col-xl-4 col-lg-6 mt-3" style="width: 320px">
                <div>
                    <img style="width: 310px; height: 200px; " class="img-fluid" alt="..."
                         src="{{ asset('frontend/img/checkout/front.png') }}">
                </div>
                <div class="form-group mt-3">
                    <label for="card_number">Card Number</label>
                    <input class="form-control @error('card_number') is-invalid @enderror" type="number" maxlength="16"
                           minlength="16" name="card_number" id="card_number" required
                           value="{{ $card->card_number ?? null }}"/>
                    @error('card_number')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="cardholder_name">Cardholder Name</label>
                    <input class="form-control @error('cardholder_name') is-invalid @enderror" type="text"
                           name="cardholder_name" id="cardholder_name" required
                           value="{{ $card->cardholder_name ?? null }}"/>
                    @error('cardholder_name')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="month">Month</label>
                            <select required class="form-control @error('month') is-invalid @enderror" name="month"
                                    id="month">
                                <option value="" selected hidden>Select Month</option>
                                <option {{ $card ? $card->month === 1 ? "selected" : null : null }} value=1>01</option>
                                <option {{ $card ? $card->month === 2 ? "selected" : null : null }} value=2>02</option>
                                <option {{ $card ? $card->month === 3 ? "selected" : null : null }} value=3>03</option>
                                <option {{ $card ? $card->month === 4 ? "selected" : null : null }} value=4>04</option>
                                <option {{ $card ? $card->month === 5 ? "selected" : null : null }} value=5>05</option>
                                <option {{ $card ? $card->month === 6 ? "selected" : null : null }} value=6>06</option>
                                <option {{ $card ? $card->month === 7 ? "selected" : null : null }} value=7>07</option>
                                <option {{ $card ? $card->month === 8 ? "selected" : null : null }} value=8>08</option>
                                <option {{ $card ? $card->month === 9 ? "selected" : null : null }} value=9>09</option>
                                <option {{ $card ? $card->month === 10 ? "selected" : null : null }} value=10>10</option>
                                <option {{ $card ? $card->month === 11 ? "selected" : null : null }} value=11>11</option>
                                <option {{ $card ? $card->month === 12 ? "selected" : null : null }} value=12>12</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="year">Year</label>
                            <input type="text" value="{{ $card->year ?? null }}" required
                                   class="form-control @error('year') is-invalid @enderror" id="year"
                                   name="year">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 mt-3" style="width: 320px">
                <div>
                    <img style="width: 310px; height: 200px; " class="img-fluid" alt="..."
                         src="{{ asset('frontend/img/checkout/back.png') }}">
                </div>
                <div class="form-group mt-3">
                    <label for="cvv_number">CVV Number</label>
                    <input class="form-control @error('cvv_number') is-invalid @enderror" type="number" maxlength="3"
                           minlength="3" name="cvv_number" id="cvv_number" required
                           value="{{ $card->cvv_number ?? null }}"/>
                    @error('cvv_number')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
            </div>
            <div class="col-xl-2"></div>

            <div class="col-xl-2"></div>
            <div class="col-xl-6 col-lg-6 mt-3">
{{--                <div class="d-grid mt-3">--}}
{{--                    <div class="form-check">--}}
{{--                        <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember">--}}
{{--                        <label class="form-check-label" for="remember">--}}
{{--                            Remember Cards Details--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="d-grid mt-2">
                    <button type="submit" class="btn btn-block btn-custom">Pay Now</button>
                </div>
            </div>
            <div class="col-xl-2"></div>
        </form>


    </div>
@endsection

@section("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="{{ asset('frontend/js/yearpicker.js') }}"></script>

    <script>
        document.addEventListener("wheel", function (event) {
            if (document.activeElement.type === "number") {
                document.activeElement.blur();
            }
        });

        $(document).ready(function () {
            $("#year").yearpicker({
                year: 2021,
                startYear: {{ \Illuminate\Support\Carbon::now()->year }},
                endYear: {{ \Illuminate\Support\Carbon::now()->year + 6 }},
            });
        });

    </script>
@endsection
