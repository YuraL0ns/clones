<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-building"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Интехком | RPC Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Главная страница</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Управление пользователями
    </div>

    @can('show role')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('roles.index') }}">
            <i class="fas fa-user-tag"></i>
            <span>Роли</span>
        </a>
    </li>
    @endcan

    @can('show permission')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('permissions.index') }}">
            <i class="fas fa-user-lock"></i>
            <span>Права</span>
        </a>
    </li>
    @endcan

    @can('show user')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            <span>Пользователи</span>
        </a>
    </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Управление предприятием
    </div>

    @can('show project')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('projects.index') }}">
            <i class="fas fa-project-diagram"></i>
            <span>Проекты</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('sklad.index') }}">
            <i class="fas fa-project-diagram"></i>
            <span>Склад</span>
        </a>
    </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->