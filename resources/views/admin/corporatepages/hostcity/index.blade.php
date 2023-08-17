@extends('admin.layout.app')
@section('title', 'Host Cities | ')

@section('content')
    <div class="content-wrapper" style="margin-left:0px !important">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Host Cities</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.corporatePages.list') }}">Corporate Pages</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.hostCities.list') }}">Host Cities</a></li>
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
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-12 d-flex my-3 justify-content-start">
                                        <div>
                                            <a href="{{ route('admin.hostCities.add') }}"
                                               class="btn btn-custom btn-small">Add new Host City</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                                        Image
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1">Action
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($hostCities as $key => $hostCity)
                                                    <tr role="row" class="odd">
                                                        <td tabindex="0" class="sorting_1">{{ ++$key }}</td>
                                                        <td>
                                                            <img
                                                                src="{{ asset('storage/'.substr($hostCity->image, 6)) }}"
                                                                width="100" alt="..." class="img-fluid">
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-small btn-custom"
                                                               href="{{ route('admin.hostCities.edit', ["id" => $hostCity->id]) }}">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                            <a class="btn btn-small btn-custom"
                                                               href="{{ route('admin.hostCities.delete', ["id" => $hostCity->id]) }}">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
{{--                                    <div class="row">--}}
{{--                                        <div class="col-sm-12 col-md-7">--}}
{{--                                            {!! $hostCities->links() !!}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
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
