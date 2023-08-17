@extends('admin.layout.app')
@section('title', 'Vote Plans | ')

@section('content')
    <div class="content-wrapper" style="margin-left:0px !important">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Vote Plans</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.votePlans.list') }}">Vote Plans</a></li>
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
                                    <div class="col-12 d-flex my-3 justify-content-between">
                                        <div class="">
                                            <a href="{{ route('admin.votePlans.add') }}"
                                               class="btn btn-custom btn-small">Add New Vote Plan</a>
                                        </div>

                                        <div>
                                            <a href="{{ route('admin.votePlans.download') }}"
                                               class="btn btn-custom btn-small">Download Excel</a>
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
                                                        Plan Name
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1">
                                                        Votes
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1">
                                                        Price
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1">Action
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tfoot>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Plan Name</th>
                                                    <th>Votes</th>
                                                    <th>Price</th>
                                                    <td></td>
                                                </tr>
                                                </tfoot>

                                                <tbody>
                                                @foreach($votePlans as $key => $votePlan)
                                                    <tr role="row" class="odd">
                                                        <td tabindex="0" class="sorting_1">{{ ++$key }}</td>
                                                        <td>{{ $votePlan->plan_name }}</td>
                                                        <td>{{ $votePlan->votes }}</td>
                                                        <td>{{ $votePlan->price }}</td>
                                                        <td>
                                                            <a class="btn btn-small btn-custom"
                                                               href="{{ route('admin.votePlans.edit', ["id" => $votePlan->id]) }}">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                            <a class="btn btn-small btn-custom"
                                                               href="{{ route('admin.votePlans.delete', ["id" => $votePlan->id]) }}">
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
{{--                                            {!! $votePlans->links() !!}--}}
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
