@extends('admin.layout.app')
@section('title', 'Corporate Pages | ')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit {{ $data->key }} </h1>
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

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit {{ $data->key }}</h3>
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
                        <form role="form" action="{{ route('admin.corporatePages.update', ["key" => $data->key]) }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="banner">Banner <span
                                            style="font-size: 12px; color: grey">(590x360)</span></label>
                                    <input onchange="loadFile(event)" accept="image/*" type="file" class="form-control"
                                           id="banner" name="banner"/>
                                </div>

                                <div class="form-group">
                                    <label for="heading">Heading</label>
                                    <input type="text" class="form-control" id="heading" name="heading"
                                           value="{{ $data->heading }}">
                                </div>

                                <div class="form-group">
                                    <label for="sub_heading">Sub Heading</label>
                                    <textarea class="form-control" id="sub_heading"
                                              name="sub_heading">{{ $data->sub_heading }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" id="content" name="content"
                                              style="height: 300px;">{{ $data->content }}</textarea>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-custom">Update</button>
                            </div>
                        </form>
                        <div class="mt-5 mb-5 text-center">
                            <img width="590" height="360" class="img-fluid" id="bannerPreview"
                                 src="{{ $data->banner != null ? asset('storage/'.substr($data->banner, 6)) : "https://via.placeholder.com/590x360.png" }}"
                                 alt="...">
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-3"></div>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
    <script>
        const loadFile = function (event) {
            let output = document.getElementById('bannerPreview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection
