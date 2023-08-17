<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs("admin.dashboard") ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>

            </li>
            <li class="nav-item">
                <a href="{{ route('admin.manageUser.list') }}" class="nav-link {{ request()->routeIs("admin.manageUser.*") ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Manage Users
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.userAllComments.list') }}" class="nav-link {{ request()->routeIs("admin.userAllComments.*") ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Users All Comments
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.votePlans.list') }}" class="nav-link {{ request()->routeIs("admin.votePlans.*") ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Vote Plans
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.voteOrders.list') }}" class="nav-link {{ request()->routeIs("admin.voteOrders.*") ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Vote Orders
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.nominations.list') }}" class="nav-link {{ request()->routeIs("admin.nominations.*") ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Nominations
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.inquiries.list') }}" class="nav-link {{ request()->routeIs("admin.inquiries.*") ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Inquiries
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.corporatePages.list') }}" class="nav-link {{ request()->routeIs("admin.corporatePages.*") ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Corporate Pages
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.appSetting.index') }}" class="nav-link {{ request()->routeIs("admin.appSetting.*") ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        App Setting
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
