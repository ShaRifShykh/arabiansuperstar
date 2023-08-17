@extends('admin.layout.app')
@section('title', 'Manage Users | ')

@section("styles")
    <style>
        .select {
            display: flex;
            flex-wrap: wrap;
        }

        .select__item {
            margin-right: 5px;
            margin-bottom: 5px;
            padding: 10px 15px 10px 15px;
            cursor: pointer;
            text-align: center;
            border-radius: 10px;
            font-size: 12px;
            border: 0.5px solid red;
            transition: background 0.1s;
        }

        .select__item--selected {
            background: linear-gradient(180deg, rgba(204, 45, 58, 1) 0%, rgba(93, 47, 19, 1) 100%);
            color: #ffffff;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper" style="margin-left:0px !important">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit User </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.manageUser.list') }}">Manage Users</a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        {{--                        {{ session('success') }}--}}
                        <div class="card-header">
                            <h3 class="card-title">Edit User</h3>
                        </div>
                        <!-- /.card-header -->

                        @if(session('success'))
                            <div>
                                <div class="alert alert-success" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                </div>
                            </div>
                    @endif

                    <!-- form start -->
                        <form role="form" action="{{ route('admin.manageUser.update', ["id" => $user->id]) }}"
                              method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="full_name"
                                           value="{{ $user->full_name }}" placeholder="Full Name">
                                    @error('full_name')
                                    <div>
                                        <div class="alert alert-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                           value="{{ $user->username }}" placeholder="Enter your Username">
                                    @error('username')
                                    <div>
                                        <div class="alert alert-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{ $user->email }}"
                                           name="email" placeholder="Enter your Email">
                                    @error('email')
                                    <div>
                                        <div class="alert alert-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone_no">Phone</label>
                                    <input type="text" class="form-control" id="phone_no" name="phone_no"
                                           value="{{ $user->phone_no }}" placeholder="Phone No">
                                </div>

                                <div class="form-group">
                                    <label for="country">Select Country</label>
                                    <select class="form-control" id="country" name="country">
                                        <option selected disabled>Select Country</option>
                                        @foreach($countries as $country)
                                            <option
                                                {{ $country->name == $user->country ? "selected" : null }} value="{{ $country->name }}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nationality">Select Nationality</label>
                                    <select class="form-control" id="nationality" name="nationality">
                                        <option selected disabled>Select Nationality</option>
                                        @foreach($countries as $country)
                                            <option
                                                {{ $country->name == $user->nationality ? "selected" : null }} value="{{ $country->name }}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                           value="{{ $user->date_of_birth }}" onchange="getZodiacSign(this.value)"
                                           placeholder="Date of Birth">
                                </div>

                                <div class="form-group">
                                    <label for="zodiac">Zodiac</label>
                                    <input type="text" class="form-control" id="zodiac" value="{{ $user->zodiac }}"
                                           name="zodiac" placeholder="Zodiac">
                                </div>

                                <div class="form-group">
                                    <label for="bio">Bio</label>
                                    <textarea class="form-control" id="bio" name="bio">{{ $user->bio }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="hobbies">Hobbies</label>
                                    <textarea class="form-control" id="hobbies"
                                              name="hobbies">{{ $user->hobbies }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select onchange="genderChange(this)" id="gender" class="form-control" name="gender">
                                        <option {{ $user->gender == "Male" ? "selected" : null }} value="Male">Male
                                        </option>
                                        <option {{ $user->gender == "Female" ? "selected" : null }} value="Female">
                                            Female
                                        </option>
                                    </select>
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="form-group" id="maleNominations">
                                        <label for="nominations">Nominations</label>
                                        <select multiple
                                                class="custom-select @error('nominations') is-invalid @enderror"
                                                name="maleNominations[]" id="nominations">
                                            @foreach($maleNominations as $nomination)
                                                <option
                                                    {{ collect($userSelectedNomination)->contains($nomination->id) ? "selected" : null }}
                                                    {{ $nomination->id == 1 ? "selected" : null }} value={{ $nomination->id }}>{{ $nomination->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('nominations')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group" id="femaleNominations">
                                        <label for="nominations">Nominations</label>
                                        <select multiple
                                                class="custom-select @error('nominations') is-invalid @enderror"
                                                name="femaleNominations[]" id="nominations">
                                            @foreach($femaleNominations as $nomination)
                                                <option
                                                    {{ collect($userSelectedNomination)->contains($nomination->id) ? "selected" : null }}
                                                    {{ $nomination->id == 1 ? "selected" : null }} value="{{ $nomination->id }}">{{ $nomination->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('nominations')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-custom">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->


                </div>
                <div class="col-md-3"></div>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection


@section("scripts")
    <script>
        class CustomSelect {
            constructor(originalSelect) {
                this.originalSelect = originalSelect;
                this.customSelect = document.createElement("div");
                this.customSelect.classList.add("select");

                this.originalSelect.querySelectorAll("option").forEach((optionElement) => {
                    const itemElement = document.createElement("div");

                    itemElement.classList.add("select__item");
                    itemElement.textContent = optionElement.textContent;
                    this.customSelect.appendChild(itemElement);

                    if (optionElement.selected) {
                        this._select(itemElement);
                    }

                    itemElement.addEventListener("click", () => {
                        if (
                            this.originalSelect.multiple &&
                            itemElement.classList.contains("select__item--selected")
                        ) {
                            this._deselect(itemElement);
                        } else {
                            this._select(itemElement);
                        }
                    });
                });

                this.originalSelect.insertAdjacentElement("afterend", this.customSelect);
                this.originalSelect.style.display = "none";
            }

            _select(itemElement) {
                const index = Array.from(this.customSelect.children).indexOf(itemElement);

                if (!this.originalSelect.multiple) {
                    this.customSelect.querySelectorAll(".select__item").forEach((el) => {
                        el.classList.remove("select__item--selected");
                    });
                }

                this.originalSelect.querySelectorAll("option")[index].selected = true;
                itemElement.classList.add("select__item--selected");
            }

            _deselect(itemElement) {
                const index = Array.from(this.customSelect.children).indexOf(itemElement);

                this.originalSelect.querySelectorAll("option")[index].selected = false;
                itemElement.classList.remove("select__item--selected");
            }
        }

        document.querySelectorAll(".custom-select").forEach((selectElement) => {
            new CustomSelect(selectElement);
        });

        document.addEventListener('DOMContentLoaded', function () {
            var gender = "{{ $user->gender }}";
            if (gender === "Male") {
                $('#maleNominations').show();
                $('#femaleNominations').hide();
            } else if (gender === "Female") {
                $('#maleNominations').hide();
                $('#femaleNominations').show();
            }
        }, false);

        function genderChange(event) {
            if (event.value === "Male") {
                $('#maleNominations').show();
                $('#femaleNominations').hide();
            } else if (event.value === "Female") {
                $('#maleNominations').hide();
                $('#femaleNominations').show();
            }
        }

        $(document).ready(function () {
            var readURL = function (input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.avatar').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

        });
    </script>
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

        const getZodiacSign = (value) => {
            let zodiac = document.getElementById("zodiac").value = new ZodiacSign(value).sign;
        }
    </script>
@endsection
