@extends('admin.layout.app')
@section("title", "Dashboard | ")

@section('content')
    <div class="content-wrapper" style="margin-left:0px !important">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $totalUsers }}</h3>
                                <p>NUMBER OF USERS</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('admin.manageUser.list') }}" class="small-box-footer"
                            >More info <i class="fas fa-arrow-circle-right"></i
                                ></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $totalUsersOf360 }}</h3>
                                <p>TOTAL USER OF 360</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.manageUser.users360.list') }}" class="small-box-footer"
                            >More info <i class="fas fa-arrow-circle-right"></i
                                ></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $totalUsersOf72 }}</h3>
                                <p>TOTAL USER OF 72</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('admin.manageUser.users72.list') }}" class="small-box-footer"
                            >More info <i class="fas fa-arrow-circle-right"></i
                                ></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $totalMaleUsers }}</h3>
                                <p>TOTAL MALE USERS</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('admin.manageUser.list', ["gender" => "Male"]) }}" class="small-box-footer"
                            >More info <i class="fas fa-arrow-circle-right"></i
                                ></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $totalFemaleUsers }}</h3>
                                <p>TOTAL FEMALE USERS</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('admin.manageUser.list', ["gender" => "Female"]) }}" class="small-box-footer"
                            >More info <i class="fas fa-arrow-circle-right"></i
                                ></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $totalVotePlans }}</h3>
                                <p>VOTE PLANS</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.votePlans.list') }}" class="small-box-footer"
                            >More info <i class="fas fa-arrow-circle-right"></i
                                ></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $totalOrders }}</h3>
                                <p>TOTAL ORDERS</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('admin.voteOrders.list') }}" class="small-box-footer"
                            >More info <i class="fas fa-arrow-circle-right"></i
                                ></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $totalInquiries }}</h3>
                                <p>INQUIRIES</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('admin.inquiries.list') }}" class="small-box-footer"
                            >More info <i class="fas fa-arrow-circle-right"></i
                                ></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
