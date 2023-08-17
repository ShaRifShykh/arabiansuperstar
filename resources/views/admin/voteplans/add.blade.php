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

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        {{--                        {{ session('success') }}--}}
                        <div class="card-header">
                            <h3 class="card-title">Add new Vote Plan</h3>
                        </div>
                        <!-- /.card-header -->


                    <!-- form start -->
                        <form role="form" action="{{ route('admin.votePlans.insert') }}"
                              method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="plan_name">Plan Name</label>
                                    <input type="text" class="form-control" id="plan_name" name="plan_name"
                                           value="{{ old("plan_name") }}" placeholder="Plan Name">
                                    @error('plan_name')
                                    <div>
                                        <div class="alert alert-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="votes">Votes</label>
                                    <input type="number" class="form-control" id="votes" name="votes"
                                           value="{{ old('votes') }}" placeholder="Votes">
                                    @error('votes')
                                    <div>
                                        <div class="alert alert-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price"
                                           value="{{ old('price') }}" placeholder="Price">
                                    @error('price')
                                    <div>
                                        <div class="alert alert-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    </div>
                                    @enderror
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
