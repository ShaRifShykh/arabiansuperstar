@extends("frontend.layout.app")
@section("title", "Add Personality Info | ")

@section("styles")
    <style>
        .slider1 {
            padding: 0;
        }

        .form-control, .form-select {
            border: 1px solid rgb(83, 74, 74);
        }

        .form-control:focus, .form-select:focus {
            box-shadow: none;
            border: 1px solid red;
            outline: 0 none;
        }

        .form-group i {
            font-size: 28px;
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

        .select {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            max-width: 300px;
            gap: 3px;
        }

        .select__item {
            padding: 10px 5px 10px 5px;
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

@section("section")
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-2"></div> -->
            <div class="col-lg-7 col-md-12 col-sm-12 slider1">
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


            <div class="col-lg-5  col-md-12 col-sm-12 form scrollContainer" style="padding: 0px 150px 0px 150px; height: 700px">
                <div class="logo me-auto mt-4 text-center"><a href="{{ route("home") }}">
                        <img class="img-fluid" src="{{ asset('frontend/img/logo.png') }}" alt="..."/>
                    </a>
                </div>

                <div class="mt-5 mb-5">
                    <h4 class="fw-bolder">Personality</h4>

                    <form action="{{ route("addPersonality") }}" method="post" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="hobbies">Hobbies <span style="font-size: 12px; color: grey">: (for e.g., Sports, Music, Reading) - Limit 50 words </span></label>
                            <textarea onkeyup="countWords()" rows="5" data-announce="true"
                                      class="form-control @error('hobbies') is-invalid @enderror"
                                      name="hobbies" id="hobbies">{{ $user->hobbies }}</textarea>
                            <span style="font-size: 12px; color: grey">Words Count: <span id="count">50</span></span>
                            @error('hobbies')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="nominations">Nominations</label>
                            <p style="font-size: 12px; color: grey">You’re nominated for Arabian superstar Nominate
                                yourself for more titles</p>
                            <select multiple class="custom-select @error('nominations') is-invalid @enderror"
                                    name="nominations[]"
                                    id="nominations">
                                @foreach($nominations as $nomination)
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

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-block btn-custom">Next</button>
                        </div>

                        <div class="text-center mt-5">
                            <div class="d-flex">
                                <a href="{{ route("addPersonalDetailView") }}">
                                    <i class="fa-solid fa-chevron-left"></i>
                                    <span>Back</span>
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
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

        function countWords() {
            let text = document.getElementById("hobbies").value;
            let numWords = 49;

            for (let i = 0; i < text.length; i++) {
                let currentCharacter = text[i];
                if (currentCharacter === " ") {
                    numWords -= 1;
                }
            }
            numWords += 1;
            document.getElementById("count").innerHTML = numWords;
        }

        $('textarea[name=hobbies]').keyup(function () {
            // Get value of textarea
            var str = $('textarea[name=hobbies]').val();
            // Check if value has more than 20 words
            if (str.split(" ").length > 50) {
                // Create string with first 20 words
                var str_new = str.split(" ").splice(0, 50).join(" ");
                // Overwrite the content with the first 20 words
                $('textarea[name=hobbies]').val(str_new);
            }
        });

    </script>
@endsection

