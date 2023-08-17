@extends('admin.layout.app')
@section('title', 'Corporate Pages | ')

@section('content')
    <div class="content-wrapper" style="margin-left:0px !important">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Corporate Pages</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.corporatePages.list') }}">Corporate
                                    Pages</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        {{--                            <div class="card-header">--}}
                        {{--                                <div class="row">--}}
                        {{--                                    <div class="col-sm-12 col-md-12">--}}
                        {{--                                        <div id="example1_filter">--}}
                        {{--                                            <input id="data_search" type="search" class="form-control"--}}
                        {{--                                                   placeholder="Search Pages..." aria-controls="example1">--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}

                        <!-- /.card-header -->
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                    <div class="row">
                                        @if(session('success'))
                                            <div class="col-sm-12">
                                                <div class="alert alert-success" role="alert">
                                                    <strong>{{ session('success') }}</strong>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-sm-12">
                                            <table id="example1"
                                                   class="table table-bordered table-striped dataTable dtr-inline"
                                                   role="grid" aria-describedby="example1_info">
                                                <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1" aria-sort="ascending">
                                                        S.No
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1">
                                                        Page Name
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1">Action
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1">Edit Page Content
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">1</td>
                                                    <td>Home Slider</td>
                                                    <td></td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.sliders.profile.list') }}">
                                                            Add Slider Images</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">2</td>
                                                    <td>Login/Signup Slider</td>
                                                    <td></td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.sliders.auth.list') }}">
                                                            Add Slider Images</a>
                                                    </td>
                                                </tr>


                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">3</td>
                                                    <td>Comment</td>
                                                    <td></td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.sliders.comment.list') }}">
                                                            Add Slider Images</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">4</td>
                                                    <td>Search</td>
                                                    <td></td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.sliders.search.list') }}">
                                                            Add Slider Images</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">5</td>
                                                    <td>Notification</td>
                                                    <td></td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.sliders.notification.list') }}">
                                                            Add Slider Images</a>
                                                    </td>
                                                </tr>


                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">6</td>
                                                    <td>Prizes</td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.corporatePages.edit', ["key" => 'prizes']) }}">
                                                            Edit Page</a>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">7</td>
                                                    <td>Judges</td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.corporatePages.edit', ["key" => 'judges']) }}">
                                                            Edit Page</a>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.judges.list') }}">
                                                            Add Judges</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">8</td>
                                                    <td>Host City</td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.corporatePages.edit', ["key" => 'host_city']) }}">
                                                            Edit Page</a>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.hostCities.list') }}">
                                                            Add Host City</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">9</td>
                                                    <td>Associates</td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.corporatePages.edit', ["key" => 'associates']) }}">
                                                            Edit Page</a>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.associates.list') }}">
                                                            Add Associate</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">10</td>
                                                    <td>Sponsorship</td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.corporatePages.edit', ["key" => 'sponsorship']) }}">
                                                            Edit Page</a>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">11</td>
                                                    <td>Event Tickets</td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.corporatePages.edit', ["key" => 'events_tickets']) }}">
                                                            Edit Page</a>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">12</td>
                                                    <td>FAQs</td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.corporatePages.edit', ["key" => 'faqs']) }}">
                                                            Edit Page</a>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.faqs.list') }}">
                                                            Add FAQS</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">13</td>
                                                    <td>How it Works</td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.corporatePages.edit', ["key" => 'how_it_works']) }}">
                                                            Edit Page</a>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">14</td>
                                                    <td>Eligibility</td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.corporatePages.edit', ["key" => 'eligibility']) }}">
                                                            Edit Page</a>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">15</td>
                                                    <td>Countries</td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.corporatePages.edit', ["key" => 'countries']) }}">
                                                            Edit Page</a>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.participatingCountries.list') }}">
                                                            Edit Countries</a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">16</td>
                                                    <td>Contact Us</td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.corporatePages.edit', ["key" => 'contact_us']) }}">
                                                            Edit Page</a>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">17</td>
                                                    <td>Terms & Conditions</td>
                                                    <td>
                                                        <a class="btn btn-small btn-custom"
                                                           href="{{ route('admin.corporatePages.edit', ["key" => 'terms_and_conditions']) }}">
                                                            Edit Page</a>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
@endsection
