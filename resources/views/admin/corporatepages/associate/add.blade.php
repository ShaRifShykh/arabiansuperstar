@extends('admin.layout.app')
@section('title', 'Associates | ')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add Associate </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.corporatePages.list') }}">Corporate Pages</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.associates.list') }}">Associates</a></li>
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
                        <div class="card-header">
                            <h3 class="card-title">Add Associate</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form role="form" action="{{ route('admin.associates.insert') }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="heading">Heading</label>
                                    <input required type="text" class="form-control" id="heading" name="heading">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea required class="form-control" id="description"
                                              name="description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="bg_image">Background Image</label>
                                    <input required type="file" class="form-control" id="bg_image" name="bg_image">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-custom">Add</button>
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
