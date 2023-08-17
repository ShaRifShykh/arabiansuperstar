@extends('admin.layout.app')
@section('title', 'Participating Countries | ')

@section('content')
    <div class="content-wrapper" style="margin-left:0px !important">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Participating Countries</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.corporatePages.list') }}">Corporate Pages</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.participatingCountries.list') }}">Participating Countries</a></li>
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
                                            <a href="{{ route('admin.participatingCountries.add') }}"
                                               class="btn btn-custom btn-small">Add new Country</a>
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
                                                        Name
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1">
                                                        Flag
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1">Action
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tfoot>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Name</th>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                </tfoot>

                                                <tbody>
                                                @foreach($participatingCountries as $key => $participatingCountry)
                                                    <tr role="row" class="odd">
                                                        <td tabindex="0" class="sorting_1">{{ ++$key }}</td>
                                                        <td>{{ $participatingCountry->name }}</td>
                                                        <td>
                                                            <img width="100" class="img-fluid"
                                                                 src="{{ asset('storage/'.substr($participatingCountry->flag, 6)) }}"
                                                                 alt="..."/>
                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('admin.participatingCountries.editStatus', ["id" => $participatingCountry->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="custom-control custom-switch">
                                                                    <input
                                                                        {{ $participatingCountry->status == 0 ? "checked" : null }} type="checkbox"
                                                                        class="custom-control-input" id="block{{ $participatingCountry->id }}"
                                                                        name="status" onClick="this.form.submit()">
                                                                    <label class="custom-control-label" for="block{{ $participatingCountry->id }}">Active / Deactive</label>
                                                                </div>
                                                            </form>
                                                            <a class="btn btn-small btn-custom"
                                                               href="{{ route('admin.participatingCountries.edit', ["id" => $participatingCountry->id]) }}">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                            <a class="btn btn-small btn-custom"
                                                               href="{{ route('admin.participatingCountries.delete', ["id" => $participatingCountry->id]) }}">
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
{{--                                            {!! $participatingCountries->links() !!}--}}
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
