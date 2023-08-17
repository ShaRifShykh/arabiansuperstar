<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left:0px !important;">
    <a href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('frontend/img/favicon.png') }}" alt="Logo" class="img-fluid p-3" style="width: 70px">
    </a>

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs("admin.dashboard") ? 'active' : '' }}">Dashboard</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.manageUser.list') }}"
               class="nav-link {{ request()->routeIs("admin.manageUser.*") ? 'active' : '' }}">Manage Users</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.userAllComments.list') }}"
               class="nav-link {{ request()->routeIs("admin.userAllComments.*") ? 'active' : '' }}">Users All
                Comments</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.votePlans.list') }}"
               class="nav-link {{ request()->routeIs("admin.votePlans.*") ? 'active' : '' }}">Vote Plans</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.voteOrders.list') }}"
               class="nav-link {{ request()->routeIs("admin.voteOrders.*") ? 'active' : '' }}">Vote Orders</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.nominations.list') }}"
               class="nav-link {{ request()->routeIs("admin.nominations.*") ? 'active' : '' }}">Nominations</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.actions.list') }}"
               class="nav-link {{ request()->routeIs("admin.actions.*") ? 'active' : '' }}">Actions</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.inquiries.list') }}"
               class="nav-link {{ request()->routeIs("admin.inquiries.*") ? 'active' : '' }}">Inquiries</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.corporatePages.list') }}"
               class="nav-link {{ request()->routeIs("admin.corporatePages.*") ? 'active' : '' }}">Corporate
                Pages</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.appSetting.index') }}"
               class="nav-link {{ request()->routeIs("admin.appSetting.*") ? 'active' : '' }}">Web Setting</a>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-th-large"></i>
                <span class="badge badge-warning navbar-badge">Settings</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Settings</span>

                <div class="dropdown-divider"></div>

                <a href="{{ route('admin.generalSetting.edit') }}" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i>{{ __('General Setting') }}
                    <span class="float-right text-muted text-sm"></span>
                </a>

                <div class="dropdown-divider"></div>

                <a href="{{ route('admin.auth.logout') }}" class="dropdown-item"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-file mr-2"></i>{{ __('Logout') }}
                    <span class="float-right text-muted text-sm"></span>

                    <form id="logout-form" action="{{ route('admin.auth.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>

                <div class="dropdown-divider"></div>
            </div>
        </li>

    </ul>
</nav>
<br>
