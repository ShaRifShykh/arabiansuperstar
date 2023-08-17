<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')Arabian Superstar Admin Panel</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('frontend/img/favicon.png') }}" type="image/x-icon">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }
        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
        .sidebardelete {
            display: none !important;
        }
        .content-wrapper {
            margin-left: 0px !important;
        }
        .dataTables_scroll {
            position: relative
        }
        .dataTables_scrollHead {
            margin-bottom: 40px;
        }
        .dataTables_scrollFoot {
            position: absolute;
            top: 50px
        }
        .dataTables_filter {
            display: none
        }
        .btn-custom {
            padding: 10px 12px;
            background: rgb(204, 45, 58);
            background: linear-gradient(180deg, rgba(204, 45, 58, 1) 0%, rgba(93, 47, 19, 1) 100%);
            color: #ffffff;
            border-radius: 8px;
        }
        .btn-custom:hover {
            background: rgb(204, 45, 58);
            background: linear-gradient(90deg, rgba(204, 45, 58, 1) 0%, rgba(93, 47, 19, 1) 100%);
            color: #ffffff;
            border-radius: 8px;
        }
        .dropdown-item.active, .dropdown-item:active {
            background-color: transparent;
            color: black;
        }
        a, a:hover {
            color: rgb(204, 45, 58);
        }
        .custom-control-input:checked~.custom-control-label::before {
            border-color: rgb(204, 45, 58);
            background-color: rgb(204, 45, 58);
        }
        .card-primary:not(.card-outline)>.card-header, .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            background-color: rgb(204, 45, 58);
        }
        .dataTables_scrollBody {
            height: 800px;
        }
    </style>

    @yield("styles")
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Navbar -->
@include('admin.layout.header')
<!-- /.navbar -->


    <!-- Content Wrapper. Contains page content -->
@yield('content')
<!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('admin.layout.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('admin/dist/js/demo.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('admin/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{ asset('admin/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('admin/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{ asset('admin/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<!-- ChartJS -->
<script src="{{ asset('admin/plugins/chart.js/Chart.min.js')}}"></script>

<!-- PAGE SCRIPTS -->
<script src="{{ asset('admin/dist/js/pages/dashboard2.js')}}"></script>

@yield('scripts')

<script type='text/javascript'>
    $(document).ready(function () {

        // Search all columns
        $('#data_search').keyup(function () {
            var search = $(this).val();

            $('table tbody tr').hide();

            var len = $('table tbody tr:not(.notfound) td:contains("' + search + '")').length;

            if (len > 0) {
                $('table tbody tr:not(.notfound) td:contains("' + search + '")').each(function () {
                    $(this).closest('tr').show();
                });
            } else {
                $('.notfound').show();
            }
        });

        // Setup - add a text input to each header cell
        $('#example1 tfoot th').each(function () {
            var title = $('#example1 thead th').eq($(this).index()).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });

        // DataTable
        var table = $('#example1').DataTable({
            paging: false,
            ordering: false,
            info: false,
            scrollX: true,
        });

        // Apply the search
        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {
                that
                    .search(this.value)
                    .draw();
            });
        });
    });
    // Case-insensitive searching (Note - remove the below script for Case sensitive search )
    $.expr[":"].contains = $.expr.createPseudo(function (arg) {
        return function (elem) {
            return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    });

    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });
</script>

</body>
</html>
