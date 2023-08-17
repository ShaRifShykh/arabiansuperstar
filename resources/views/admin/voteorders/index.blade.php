@extends('admin.layout.app')
@section('title', 'Vote Orders | ')

@section('content')
    <div class="content-wrapper"  style="margin-left:0px !important">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Vote Orders</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">Vote Orders</li>
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
                                    <div class="col-12 d-flex my-3 justify-content-end">
                                        <div>
                                            <a href="{{ route('admin.voteOrders.download') }}"
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
                                                        Order No
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
                                                        rowspan="1" colspan="1">
                                                        Email
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1">
                                                        Total Amount
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1">
                                                        Payment Status
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1">
                                                        Purchase Date
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1">Action
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tfoot>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Order No</th>
                                                    <th>Plan Name</th>
                                                    <th>Votes</th>
                                                    <th>Price</th>
                                                    <th>Email</th>
                                                    <th>Total Amount</th>
                                                    <th>Payment Status</th>
                                                    <th>Purchase Date</th>
                                                    <td></td>
                                                </tr>
                                                </tfoot>

                                                <tbody>
                                                @foreach($voteOrders as $key => $voteOrder)
                                                    <tr role="row" class="odd">
                                                        <td tabindex="0" class="sorting_1">{{ ++$key }}</td>
                                                        <td>{{ $voteOrder->order_id }}</td>
                                                        <td>{{ $voteOrder->votePlan->plan_name }}</td>
                                                        <td>{{ $voteOrder->votePlan->votes }}</td>
                                                        <td>{{ $voteOrder->votePlan->price }}</td>
                                                        <td>{{ $voteOrder->user->email }}</td>
                                                        <td>{{ $voteOrder->total_amount }}</td>
                                                        <td>{{ $voteOrder->payment_status }}</td>
                                                        <td>{{ \Illuminate\Support\Carbon::parse($voteOrder->created_at)->format('d-M-Y g:i A') }}</td>
                                                        <td>
                                                            <a class="btn btn-small btn-custom"
                                                               href="{{ route('admin.voteOrders.edit', ["id" => $voteOrder->id]) }}">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                            <a class="btn btn-small btn-custom"
                                                               href="{{ route('admin.voteOrders.delete', ["id" => $voteOrder->id]) }}">
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
{{--                                            {!! $voteOrders->links() !!}--}}
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
