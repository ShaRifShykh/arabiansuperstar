@extends('admin.layout.app')
@section('title', 'Comment Sliders | ')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add Comment Slider </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.corporatePages.list') }}">Corporate Pages</a>
                            <li class="breadcrumb-item"><a href="{{ route('admin.sliders.comment.list') }}">Comment Sliders</a></li>
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
                            <h3 class="card-title">Add Comment Slider</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form role="form" action="{{ route('admin.sliders.comment.insert') }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="key">For </label>
                                    <select name="key" id="key" class="form-control" required>
                                        <option value="comment_left">Comment Left Slider</option>
                                        <option value="comment_right">Comment Right Slider</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image <span
                                            style="font-size: 12px; color: grey">(340x900)</span></label>
                                    <input required type="file" class="form-control" id="image" name="image">
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
