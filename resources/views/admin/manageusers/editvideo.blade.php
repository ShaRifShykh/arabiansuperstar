@extends('admin.layout.app')
@section('title', 'Manage Users | ')

@section('content')
    <div class="content-wrapper" style="margin-left:0px !important">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit User Video </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.manageUser.list') }}">Manage Users</a></li>
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
                            <h3 class="card-title">Edit Video</h3>
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
                        <form role="form"
                              action="{{ route('admin.manageUser.updateVideo', ["id" => $userVideo->id]) }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description"
                                              name="description">{{ $userVideo->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="image">Image <span
                                            style="font-size: 12px; color: grey">(300x300)</span></label>
                                    <input onchange="loadFile(event)" accept="image/*" type="file" class="form-control"
                                           id="image" name="image"/>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-custom">Update</button>
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
