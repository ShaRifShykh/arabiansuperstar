@extends("frontend.layout.app")
@section("title", "Buy Votes | ")

@section("styles")
    <style>
        .voteContainer {
            text-align: center;
        }

        .voteOuterContainer {
            background: linear-gradient(180deg, #E7C927 0%, #B65426 100%);
            box-shadow: 2px 1px 13px 0px rgba(0, 0, 0, 0.25);
            width: 50%;
            padding: 20px 0;
            border-radius: 10px;
            position: relative;
            left: 25%;
            top: 15%;
        }

        .voteOuterContainer p {
            font-size: 20px;
            font-weight: bolder;
            color: white;
        }

        .voteInnerContainer {
            background-color: white;
            box-shadow: 2px 1px 13px 0px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            /*padding: ;*/
            padding: 50px 25px 25px;
            /*padding: 25px 13px;*/
        }
    </style>
@endsection

@section("section")
    @livewire('frontend.layout.header')

    <div class="align-self-center justify-content-center"
         style="margin: 130px 170px 120px;">

        <h2 style="font-weight: bolder" class="text-center mb-5">Buy Vote</h2>
        <div class="row justify-content-center">
            @foreach($votePlans as $votePlan)
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 voteContainer">
                    <div class="voteOuterContainer">
                        <p class="mb-0">{{ $votePlan->votes }}</p>
                        <p class="mb-0">Votes</p>
                    </div>
                    <div class="voteInnerContainer">
                        <p style="font-size: 28px">{{ $votePlan->price }}</p>
                        <p style="font-size: 10px; color: #7A869A;">Buy vote and you may win crash prizes</p>
                        <a href="{{ route('checkout', ["id" => $votePlan->id]) }}"
                           style="font-weight: bolder; color: #FEC42D">Click to buy</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
