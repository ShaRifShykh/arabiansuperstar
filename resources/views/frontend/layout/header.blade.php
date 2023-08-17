<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <h1 class="logo">
            <a href="{{ route("home") }}">
                <img src="{{ asset('frontend/img/logo.png') }}" alt="..."/>
            </a>
        </h1>

        <form action="{{ route("search") }}" method="get" class="search" id="web">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input style="width: 200px" type="search" name="s" placeholder="Search Peoples"/>
            <button id="filterDropdownToggle" onclick="showFilter()" onblur="showFilter()" type="button"
                    style="background-color: transparent; border: none">
                <img class="img-fluid" width="20" src="{{ asset('frontend/img/icons/filter.svg') }}" alt="..">
            </button>
            <div id="filterDropdown">
                <div class="row">
                    <div class="form-check col-xl-6 col-6">
                        <input class="form-check-input" type="radio" name="filter"
                               id="search" value="full_name">
                        <label class="form-check-label" for="search">
                            Full Name
                        </label>
                    </div>
                    <div class="form-check col-xl-6 col-6">
                        <input class="form-check-input" type="radio" name="filter"
                               id="search1" value="username">
                        <label class="form-check-label" for="search1">
                            Username
                        </label>
                    </div>
                    <div class="form-check col-xl-6 col-6">
                        <input class="form-check-input" type="radio" name="filter"
                               id="search2" value="email">
                        <label class="form-check-label" for="search2">
                            Email
                        </label>
                    </div>
                    <div class="form-check col-xl-6 col-6">
                        <input class="form-check-input" type="radio" name="filter"
                               id="search3" value="nationality">
                        <label class="form-check-label" for="search3">
                            Nominations
                        </label>
                    </div>
                    <div class="form-group col-xl-6 col-6">
                        @php
                            $countries = \App\Models\Country::all();
                        @endphp
                        <select class="form-select" name="country"
                                id="country">
                            <option selected disabled>Choose Country</option>
                            @foreach($countries as $country)
                                <option
                                    {{ @old("country") == $country->name ? "selected" : null }} value="{{ $country->name }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-xl-6 col-6">
                        <select class="form-select" name="gender"
                                id="gender">
                            <option selected disabled>Choose Gender</option>
                            <option {{ @old("country") == "Male" ? "selected" : null }} value="Male">Male</option>
                            <option {{ @old("country") == "Female" ? "selected" : null }} value="Female">Female</option>
                        </select>
                    </div>
                    <div class="d-grid col-xl-6 col-6 mt-3">
                        <button type="submit" class="btn btn-block btn-custom">Go</button>
                    </div>
                    <div class="d-grid col-xl-6 col-6 mt-3">
                        <button type="reset" class="btn btn-block btn-custom">Reset</button>
                    </div>
                </div>
            </div>
        </form>


        @if(\Illuminate\Support\Facades\Auth::guard("web")->check())
            <nav id="navbar" class="navbar order-last order-lg-0">
                <nav id="navbar" class="navbar container-fluid">
                    <ul class="justify-content-between">
                        <form action="{{ route("search") }}" method="get" class="search" id="mobile">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="search" name="s" placeholder="Search Peoples"/>
                            <span class="material-symbols-outlined">
                               tune
                            </span>
                        </form>

                        <a href="{{ route("home") }}" class="{{ request()->routeIs("home") ? 'active' : '' }}">
                            <li class="text-center">
                                <img class="img-fluid" width="30" src="{{ asset('frontend/img/icons/home.svg') }}"
                                     alt="..">
                                <span class="mt-2" style="display: block;font-size: 13px;">HOME</span>
                            </li>
                        </a>

                        <a href="{{ route("myVotesBucket") }}">
                            <li class="text-center">
                                <img class="img-fluid" width="30"
                                     src="{{ asset('frontend/img/icons/header_vote.svg') }}" alt="..">
                                <span class="mt-1" style="display: block; font-size: 13px;">MY VOTES</span class="mt-1">
                            </li>
                        </a>

                        <a href="{{ route("notifications") }}"
                           class="{{ request()->routeIs("notifications") ? 'active' : '' }}">
                            <li class="text-center">
                                <div class="d-flex justify-content-center">
                                    <img class="img-fluid" width="20" src="{{ asset('frontend/img/icons/bell.svg') }}"
                                         alt="..">
                                    @if(\Illuminate\Support\Facades\Auth::guard("web")->user()->notifications->count() !== 0)
                                        <span class="badge bg-danger">
                                            {{\Illuminate\Support\Facades\Auth::guard("web")->user()->notifications->count()}}
                                        </span>
                                    @endif
                                </div>
                                <span class="mt-1"
                                      style="display: block;font-size: 13px;">NOTIFICATION</span>
                            </li>
                        </a>

                        <a href="{{ route("profile") }}"
                           class="profileDD {{ request()->routeIs("profile") ? 'active' : '' }}">
                            <li class="text-center">
                                <img class="img-fluid" width="30" src="{{ asset('frontend/img/icons/profile.svg') }}"
                                     alt="..">
                                <span class="mt-1" style="display: block;font-size: 13px;">PROFILE</span>
                            </li>
                        </a>
                        <div class="profileDropdown">
                            <ul>
                                <li><a class="text-black" href="{{ route("editProfile") }}">Edit Profile</a></li>
                                <li>
                                    <a onclick="shareOnFacebook('{{ request()->getHttpHost() . '/share_profile/' . \Illuminate\Support\Facades\Auth::guard("web")->user()->username }}')"
                                       class="text-black" href="#">Share Profile to social media</a>
                                </li>
                                <li><a class="text-black" href="{{ route("myVotesBucket") }}">My Votes Bucket</a></li>
                                <li><a class="text-black" href="{{ route("faqs") }}">FAQ’S</a></li>
                                <li><a class="text-black" href="{{ route("howItWorks") }}">How it works</a></li>
                                <li><a class="text-black" href="{{ route("contactUs") }}">Contact us</a></li>
                                <li><a class="text-black" href="{{ route("termsAndConditions") }}">Terms & Condition</a>
                                </li>
                                <li><a class="text-black" href="{{ route("logout") }}">Logout</a></li>
                            </ul>
                        </div>
                    </ul>

                </nav>

                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

        @else
            <div style="padding: 20px 0;">
                <a href="{{ route("signUpView") }}" class="get-started-btn scrollto">Sign Up</a>
                <a href="{{ route("loginView") }}" style="margin-left: 10px;color: black;font-size: 12px;">Login</a>
            </div>
        @endif
    </div>
</header><!-- End Header -->
