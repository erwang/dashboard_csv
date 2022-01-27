<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-stream"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{!! env('APP_NAME_HTML') !!}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item menu">
        <a class="nav-link menu font-weight-bold" href="{{route('file')}}" data-target="#file">
            <i class="fas fa-fw fa-file-csv"></i>
            <span style="font-size: 1.3em">{{__('File')}}</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item menu">
        <a class="nav-link menu font-weight-bold" href="{{route('settings')}}" data-target="#settings">
            <i class="fas fa-fw fa-cogs"></i>
            <span style="font-size: 1.3em">{{__('Settings')}}</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item menu">
        <a class="nav-link menu font-weight-bold" href="{{route('dashboard')}}" data-target="#dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span style="font-size: 1.3em">{{__('Dashboard')}}</span></a>
    </li>
    <div class="sidebar-card d-none d-lg-flex">
        <a href="{{route('reset')}}">Remise à zéro</a>
    </div>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
