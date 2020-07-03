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
        <a class="nav-link" href="{{ route('user.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Главная страница</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @can('show project')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('project.index') }}">
                <i class="nav-icon fas fa-th"></i>
                <span>Проекты</span>
            </a>
        </li>
    @endcan

    @role('Администратор|Директор|Снабжение|Склад|Инжинер|Конструктор\АСУ')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('sklader.index') }}">
                <i class="nav-icon fas fa-th"></i>
                <span>Склады</span>
            </a>
        </li>
    @endrole

<!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->