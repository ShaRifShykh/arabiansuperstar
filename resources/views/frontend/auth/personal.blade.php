@extends("frontend.layout.app")
@section("title", "Add Personal Info | ")

@section("styles")
    <style>
        .slider1 {
            padding: 0;
        }

        .form-control, .form-select {
            border: 1px solid rgb(83, 74, 74);
        }

        .form-control:focus, .form-select:focus, .form-check-input:focus {
            box-shadow: none;
            border: 1px solid red;
            outline: 0 none;
        }

        .form-group i {
            font-size: 28px;
        }

        /*Form Input Checkbox*/
        .form-check {
            width: 150px;
            margin-top: 10px;
            position: relative;
            padding-left: 0;
            padding-right: 10px;
        }

        .form-check input[type="radio"] {
            border-radius: 10px;
            width: 100%;
            height: 50px;
            border: 1px solid red;
            -webkit-appearance: none;
            appearance: none;
            margin: 0;
        }

        .form-check input[type="radio"]:checked {
            background: linear-gradient(180deg, rgba(204, 45, 58, 1) 0%, rgba(93, 47, 19, 1) 100%);
        }

        .form-check input[type="radio"]:checked + .form-check-label {
            color: white;
        }

        .form-check label {
            position: absolute;
            left: 26%;
            top: 25%;
            /*right: 20%;*/
            align-items: center;
            justify-content: center;
            color: black;
        }

        .form-check label:checked {
            color: white;
        }

        @media screen and (max-width: 600px) {
            .form {
                padding: 0px 80px 0px 80px !important;
                margin: 50px 0px 20px 0px !important;
            }
        }

        .carousel-item img {
            height: 700px;
            object-fit: cover;
        }
    </style>
@endsection

@section("section")
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-2"></div> -->
            <div class="col-lg-7 slider1">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('frontend/img/signup1.jpeg') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('frontend/img/signup2.jpeg') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('frontend/img/signup3.jpeg') }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-5 form scrollContainer" style="padding: 0px 150px 0px 150px; height: 700px">
                <div class="logo me-auto mt-4 text-center"><a href="{{ route("home") }}">
                        <img class="img-fluid" src="{{ asset('frontend/img/logo.png') }}" alt="..."/>
                    </a>
                </div>

                <div class="mt-5 mb-5">
                    <h4 class="fw-bolder">Country / Personal</h4>

                    <form action="{{ route("addPersonalDetail") }}" method="post" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="country">Country of Residence</label>
                            <select class="form-select @error('country') is-invalid @enderror" name="country"
                                    id="country">
                                <option selected disabled>Choose Country</option>
                                @foreach($countries as $country)
                                    <option
                                        {{ @old("country") == $country->name ? "selected" : null }} {{ $user->country == $country->name ? "selected" : null }} value="{{ $country->name }}">{{ $country->name }}</option>
                                @endforeach
                            </select>

                            @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="nationality">Nationality</label>
                            <select class="form-select @error('nationality') is-invalid @enderror" name="nationality"
                                    id="nationality">
                                <option selected disabled>Choose Nationality</option>
                                @foreach($nationalities as $nationality)
                                    <option
                                        {{ $user->nationality == $nationality->name ? "selected" : null }} value="{{ $nationality->name }}">{{ $nationality->name }}</option>
                                @endforeach
                            </select>
                            @error('nationality')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="gender">Gender</label>
                            <div class="d-flex justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" checked
                                           id="gender1" value="Male" {{ $user->gender == "Male" ? "checked" : null }}>
                                    <label style="left: 30%;" class="form-check-label" for="gender1">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender"
                                           id="gender2"
                                           value="Female" {{ $user->gender == "Female" ? "checked" : null }}>
                                    <label class="form-check-label" for="gender2">
                                        Female
                                    </label>
                                </div>
                            </div>
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="date_of_birth">Date of Birth</label>
                            <input onchange="getZodiacSign(this.value)" type="date"
                                   class="form-control @error('date_of_birth') is-invalid @enderror"
                                   name="date_of_birth" value="{{ $user->date_of_birth }}" id="date_of_birth">
                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="zodiac">Zodiac Sign</label>
                            <input type="text" class="form-control" readonly
                                   name="zodiac" value="{{ $user->zodiac }}" id="zodiac">
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-block btn-custom">Next</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        class ZodiacSign {
            static signs = {
                en: ["Aries", "Taurus", "Gemini", "Cancer", "Leo", "Virgo", "Libra", "Scorpio", "Sagittarius", "Capricorn", "Aquarius", "Pisces"],
                fr: ["Bélier", "Taureau", "Gémeaux", "Cancer", "Lion", "Vierge", "Balance", "Scorpion", "Sagittaire", "Capricorne", "Vereau", "Poissons"],
                es: ["Aries", "Tauro", "Géminis", "Cáncer", "Leo", "Virgo", "Libra", "Escorpio", "Sagitario", "Capricornio", "Acuario", "Piscis"],
                ar: ["الحمل", "الثور", "الجوزاء", "السرطان", "الأسد", "العذراء", "الميزان", "العقرب", " القوس", "الجدي", "الدلو", "الحوت"]
            };
            static chineseSigns = {
                en: ["Monkey", "Rooster", "Dog", "Pig", "Rat", "Ox", "Tiger", "Rabbit", "Dragon", "Snake", "Horse", "Sheep"],
                fr: ["Singe", "Coq", "Chien", "Cochon", "Rat", "Bœuf", "Tigre", "Lapin", "Dragon", "Serpent", "Cheval", "Mouton"],
                es: ["Mono", "Gallo", "Perro", "Cerdo", "Rata", "Buey", "Tigre", "Conejo", "Dragón", "Serpiente", "Caballo", "Oveja"],
                ar: ["القرد", "الديك", "الكلب", "الخنزير", "الفأر", "الثور", "النمر", "الأرنب", "التنين", "الثعبان", "الحصان", "الخروف"]
            };
            static chineseElements = {
                en: ["Metal", "Water", "Wood", "Fire", "Earth"],
                fr: ["Métal", "Eau", "Bois", "Feu", "Terre"],
                es: ["Metal", "Agua", "Madera", "Fuego", "Tierra"],
                ar: ["المعدني", "المائي", "الخشبي", "الناري", "الأرضي"]
            };

            constructor(e, i = "en") {
                this.sign = "", this.chinese = "", Object.hasOwn(ZodiacSign.signs, i) || (i = "en"), isNaN(Date.parse(e)) || (this.sign = this.#e(e, i), this.chinese = this.#i(e, i))
            }

            #e(e, i) {
                return ZodiacSign.signs[i][Number(new Intl.DateTimeFormat("fr-TN-u-ca-persian", {month: "numeric"}).format(Date.parse(e))) - 1]
            }

            #i(e, i) {
                let a = new Intl.DateTimeFormat("fr-TN-u-ca-chinese", {
                    day: "2-digit",
                    month: "long",
                    year: "numeric"
                }).format(Date.parse(e)).substring(0, 4);
                return `${ZodiacSign.chineseElements[i][Math.floor(+a.charAt(3) / 2)]} ${ZodiacSign.chineseSigns[i][+a % 12]}`
            }
        }
    </script>

    <script>
        const getZodiacSign = (value) => {
            let zodiac = document.getElementById("zodiac").value = new ZodiacSign(value).sign;
        }
    </script>
@endsection
