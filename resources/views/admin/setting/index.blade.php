@extends('admin.layout.app')
@section('title', 'Setting | ')

@section('content')
    <div class="content-wrapper" style="margin-left:0px !important">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Setting </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.appSetting.index') }}">Setting</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
                <br>
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Setting</h3>
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
                        <form role="form" action="{{ route('admin.appSetting.update') }}"
                              method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="meta_url">Meta URL</label>
                                    <input value="{{ $metaURL->value }}" type="text" class="form-control" id="meta_url" name="meta_url">
                                </div>

                                <div class="form-group">
                                    <label for="meta_keywords">Meta Keywords</label>
                                    <textarea class="form-control" name="meta_keywords"
                                              id="meta_keywords">{{ $metaKeywords->value }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea class="form-control" name="meta_description"
                                              id="meta_description">{{ $metaDescription->value }}</textarea>
                                </div>

                                <div class="dropdown-divider"></div>

                                <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <input value="{{ $instagram->value }}" type="text" class="form-control" id="instagram" name="instagram">
                                </div>

                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input value="{{ $twitter->value }}" type="text" class="form-control" id="twitter" name="twitter">
                                </div>

                                <div class="form-group">
                                    <label for="youtube">YouTube</label>
                                    <input value="{{ $youtube->value }}" type="text" class="form-control" id="youtube" name="youtube">
                                </div>

                                <div class="form-group">
                                    <label for="snapchat">Snapchat</label>
                                    <input value="{{ $snapchat->value }}" type="text" class="form-control" id="snapchat" name="snapchat">
                                </div>

                                <div class="form-group">
                                    <label for="pinterest">Pinterest</label>
                                    <input value="{{ $pinterest->value }}" type="text" class="form-control" id="pinterest" name="pinterest">
                                </div>

                                <div class="form-group">
                                    <label for="linkedin">Linkedin</label>
                                    <input value="{{ $linkedin->value }}" type="text" class="form-control" id="linkedin" name="linkedin">
                                </div>

                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input value="{{ $facebook->value }}" type="text" class="form-control" id="facebook" name="facebook">
                                </div>

                                <div class="form-group">
                                    <label for="google">Google</label>
                                    <input value="{{ $google->value }}" type="text" class="form-control" id="google" name="google">
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
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
