@extends('admin.layout.app')
@section('title', 'Vote Orders | ')

@section('content')
    <div class="content-wrapper" style="margin-left:0px !important">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Vote Order </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.voteOrders.list') }}">Vote Orders</a></li>
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
                            <h3 class="card-title">Edit Vote Order</h3>
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
                        <form role="form" action="{{ route('admin.voteOrders.update', ["id" => $voteOrder->id]) }}"
                              method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="plan_id">Vote Plan</label>
                                    <select class="form-control" id="plan_id" name="plan_id">
                                        @foreach($votePlans as $votePlan)
                                            <option {{ $voteOrder->vote_plan_id === $votePlan->id ? "selected" : null }} value="{{ $votePlan->id }}">{{ $votePlan->plan_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="email">User Email</label>
                                    <input type="text" class="form-control" id="email" disabled
                                           value="{{ $voteOrder->user->email }}">
                                </div>

                                <div class="form-group">
                                    <label for="order_no">Order No</label>
                                    <input type="number" class="form-control" id="order_no" disabled
                                           value="{{ $voteOrder->order_id }}">
                                </div>

                                <div class="form-group">
                                    <label for="total_amount">Total Amount</label>
                                    <input type="text" class="form-control" id="total_amount" name="total_amount"
                                           value="{{ $voteOrder->total_amount }}" placeholder="Total Amount">
                                </div>

                                <div class="form-group">
                                    <label for="payment_status">Payment Status</label>
                                    <select class="form-control" id="payment_status" name="payment_status">
                                        <option {{ $voteOrder->payment_status === "Pending" ? "selected" : null }} value="Pending">Pending</option>
                                        <option {{ $voteOrder->payment_status === "Completed" ? "selected" : null }} value="Completed">Completed</option>
                                    </select>
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
