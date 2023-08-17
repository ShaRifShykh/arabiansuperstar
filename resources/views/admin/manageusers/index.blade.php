@extends('admin.layout.app')
@section('title', 'Manage Users | ')

@section('content')
    <div class="content-wrapper" style="margin-left:0px !important">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Users</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.manageUser.list') }}">Manage Users</a>
                            </li>
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
                                        <div>
                                            <a href="{{ route('admin.manageUser.users360.list') }}"
                                               class="btn btn-custom btn-small">All Users of 360</a>
                                            <a href="{{ route('admin.manageUser.users72.list') }}"
                                               class="btn btn-custom btn-small">All Users of 72</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.manageUser.download') }}"
                                               class="btn btn-custom btn-small">Download Excel</a>
                                        </div>
                                    </div>
                                    <div class="col-12 my-2">
                                        <button style="margin-bottom: 10px" class="btn btn-custom add_user360"
                                                data-url="{{ route('admin.manageUser.users360.add') }}">Add to Users 360
                                        </button>
                                        <button style="margin-bottom: 10px" class="btn btn-custom add_user72"
                                                data-url="{{ route('admin.manageUser.users72.add') }}">Add to Users 72
                                        </button>
                                        <button style="margin-bottom: 10px" class="btn btn-custom delete_all"
                                                data-url="{{ route('admin.manageUser.deleteAll') }}">Delete All Selected
                                        </button>
                                        <button style="margin-bottom: 10px" class="btn btn-custom block_all"
                                                data-url="{{ route('admin.manageUser.blockAll') }}">Block All Selected
                                        </button>
                                        <button style="margin-bottom: 10px" class="btn btn-custom un_block_all"
                                                data-url="{{ route('admin.manageUser.unBlockAll') }}">Unblock All
                                            Selected
                                        </button>
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
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Rendering engine: activate to sort column descending">
                                                        <input type="checkbox" id="master">
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">Group
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">Full
                                                        Name
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        Username
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Engine version: activate to sort column ascending">
                                                        Email
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Phone
                                                        No
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">
                                                        Country
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">
                                                        Nationality
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Gender
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Date
                                                        of Birth
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Zodiac
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Action
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tfoot>
                                                <tr>
                                                    <td></td>
                                                    <th>Group</th>
                                                    <th>Full Name</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Phone No</th>
                                                    <th>Country</th>
                                                    <th>Nationality</th>
                                                    <th>Gender</th>
                                                    <th>Date of Birth</th>
                                                    <th>Zodiac</th>
                                                    <td></td>
                                                </tr>
                                                </tfoot>

                                                <tbody>
                                                @foreach($users as $key => $user)
                                                    <tr role="row" class="odd">
                                                        <td>
                                                            <input type="checkbox" class="sub_chk"
                                                                   data-id="{{ $user->id }}"/>
                                                        </td>
                                                        <td>{{ ($user->isUser360 && $user->isUser72) ? "In Both Group" : ($user->isUser360 ? "In Users 360 Group" : ($user->isUser72 ? "In Users 72 Group" : null)) }}</td>
                                                        <td>{{ $user->full_name }}</td>
                                                        <td>{{ $user->username }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        @if($user->phone_no != null)
                                                            @php
                                                                $phoneCode = \App\Models\Country::where('name', '=', $user->country)->first();
                                                            @endphp
                                                        @endif
                                                        <td>
                                                            +{{ $phoneCode->phonecode ?? null }} {{ $user->phone_no }}</td>
                                                        <td>{{ $user->country }}</td>
                                                        <td>{{ $user->nationality }}</td>
                                                        <td>{{ $user->gender }}</td>
                                                        <td>{{ $user->date_of_birth }}</td>
                                                        <td>{{ ucfirst($user->zodiac) }}</td>
                                                        <td class="d-flex">
                                                            <div class="btn-group dropleft">
                                                                <button type="button" class="btn btn-custom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <form class="dropdown-item"
                                                                        class="mx-2"
                                                                        action="{{ route('admin.manageUser.editStatus', ["id" => $user->id]) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <div class="custom-control custom-switch">
                                                                            <input
                                                                                {{ $user->block == 1 ? "checked" : null }} type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="block{{ $user->id }}"
                                                                                name="status" onClick="this.form.submit()">
                                                                            <label class="custom-control-label"
                                                                                   for="block{{ $user->id }}">Unblock /
                                                                                Block</label>
                                                                        </div>
                                                                    </form>

                                                                    <form class="dropdown-item"
                                                                        class="mx-2"
                                                                        action="{{ route('admin.manageUser.editCommentingStatus', ["id" => $user->userAction->id]) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <div class="custom-control custom-switch">
                                                                            <input
                                                                                {{ $user->userAction->commenting == 1 ? "checked" : null }} type="checkbox"
                                                                                class="custom-control-input" name="status"
                                                                                onClick="this.form.submit()"
                                                                                id="blockCommenting{{ $user->id }}">
                                                                            <label class="custom-control-label"
                                                                                   for="blockCommenting{{ $user->id }}">Unblock
                                                                                / Block Commenting</label>
                                                                        </div>
                                                                    </form>

                                                                    <form class="dropdown-item"
                                                                        class="mx-2"
                                                                        action="{{ route('admin.manageUser.editLikingStatus', ["id" => $user->userAction->id]) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <div class="custom-control custom-switch">
                                                                            <input
                                                                                {{ $user->userAction->liking == 1 ? "checked" : null }} type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="blockLiking{{ $user->id }}"
                                                                                onClick="this.form.submit()"
                                                                                name="status">
                                                                            <label class="custom-control-label"
                                                                                   for="blockLiking{{ $user->id }}">Unblock
                                                                                / Block Liking</label>
                                                                        </div>
                                                                    </form>

                                                                    <form class="dropdown-item"
                                                                        class="mx-2"
                                                                        action="{{ route('admin.manageUser.editVotingStatus', ["id" => $user->userAction->id]) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <div class="custom-control custom-switch">
                                                                            <input
                                                                                {{ $user->userAction->voting == 1 ? "checked" : null }} type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="blockVoting{{ $user->id }}"
                                                                                onClick="this.form.submit()"
                                                                                name="status">
                                                                            <label class="custom-control-label"
                                                                                   for="blockVoting{{ $user->id }}">Unblock
                                                                                / Block Voting</label>
                                                                        </div>
                                                                    </form>

                                                                    <form class="dropdown-item"
                                                                        class="mx-2"
                                                                        action="{{ route('admin.manageUser.editRatingStatus', ["id" => $user->userAction->id]) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <div class="custom-control custom-switch">
                                                                            <input
                                                                                {{ $user->userAction->rating == 1 ? "checked" : null }} type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="blockRating{{ $user->id }}"
                                                                                onClick="this.form.submit()"
                                                                                name="status">
                                                                            <label class="custom-control-label"
                                                                                   for="blockRating{{ $user->id }}">Unblock
                                                                                / Block Rating</label>
                                                                        </div>
                                                                    </form>

                                                                    <div class="dropdown-item text-center">
                                                                        <a class="btn btn-small btn-custom mx-2"
                                                                           href="{{ route('admin.manageUser.view', ['id' => $user->id]) }}">
                                                                            <i class="fa-solid fa-eye"></i>
                                                                        </a>

                                                                        <a class="btn btn-small btn-custom mx-2"
                                                                           href="{{ route('admin.manageUser.edit', ["id" => $user->id]) }}">
                                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                                        </a>

                                                                        <a class="btn btn-small btn-custom mx-2"
                                                                           href="{{ route('admin.manageUser.delete', ["id" => $user->id]) }}">
                                                                            <i class="fa-solid fa-trash"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#master').on('click', function (e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });


            $('.delete_all').on('click', function (e) {
                var allVals = [];
                $(".sub_chk:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });


                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    var check = confirm("Are you sure you want to delete this row?");
                    if (check == true) {
                        var join_selected_values = allVals.join(",");

                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids=' + join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function () {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });


                        $.each(allVals, function (index, value) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });

            $('.block_all').on('click', function (e) {
                var allVals = [];
                $(".sub_chk:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });

                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    var check = confirm("Are you sure you want to block this row?");
                    if (check == true) {
                        var join_selected_values = allVals.join(",");

                        $.ajax({
                            url: $(this).data('url'),
                            type: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids=' + join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    location.reload();
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });
                    }
                }
            });

            $('.un_block_all').on('click', function (e) {
                var allVals = [];
                $(".sub_chk:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });

                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    var check = confirm("Are you sure you want to un block this row?");
                    if (check == true) {
                        var join_selected_values = allVals.join(",");

                        $.ajax({
                            url: $(this).data('url'),
                            type: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids=' + join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    location.reload();
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });
                    }
                }
            });

            $('.add_user360').on('click', function (e) {
                var allVals = [];
                $(".sub_chk:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });

                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    var check = confirm("Are you sure you want to add them to users 360?");
                    if (check == true) {
                        var join_selected_values = allVals.join(",");

                        $.ajax({
                            url: $(this).data('url'),
                            type: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids=' + join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    location.reload();
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });
                    }
                }
            });

            $('.add_user72').on('click', function (e) {
                var allVals = [];
                $(".sub_chk:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });

                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    var check = confirm("Are you sure you want to add them to users 72?");
                    if (check == true) {
                        var join_selected_values = allVals.join(",");

                        $.ajax({
                            url: $(this).data('url'),
                            type: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids=' + join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    location.reload();
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });
                    }
                }
            });
        });
    </script>
@endsection
