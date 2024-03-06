@extends('tampilan')

@section('content')
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="/catalog">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Nav Item - User -->
        <li class="nav-item">
            <a class="nav-link" href="/catalog/user">
                <i class="fas fa-fw fa-user"></i>
                <span>User</span>
            </a>
        </li>

        <!-- Nav Item - Device -->
        <li class="nav-item">
            <a class="nav-link" href="/catalog/device">
                <i class="fas fa-fw bi-display-fill"></i>
                <span>Device</span>
            </a>
        </li>

        <!-- Nav Item - Location -->
        <li class="nav-item">
            <a class="nav-link" href="/catalog/location">
                <i class="fas fa-fw bi-geo-alt-fill"></i>
                <span>Location</span>
            </a>
        </li>

        <!-- Nav Item - Rack -->
        <li class="nav-item">
            <a class="nav-link" href="/catalog/rack">
                <i class="fas fa-fw bi-inboxes-fill"></i>
                <span>Rack</span>
            </a>
        </li>

        <!-- Nav Item - Software -->
        <li class="nav-item">
            <a class="nav-link" href="/catalog/software">
                <i class="fas fa-fw bi-motherboard-fill"></i>
                <span>Software</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column mt-3">
        <div id="content">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>

                <div class="row">

                    <!-- User Card -->
                    <div class="col-xl-4 mb-3">
                        <div class="card border-left-primary shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <div class="text-sm font-weight-bold text-primary text-uppercase">
                                            User
                                        </div>
                                        <div class="h5 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Device Card -->
                    <div class="col-xl-4 mb-3">
                        <div class="card border-left-success shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <div class="text-sm font-weight-bold text-success text-uppercase">
                                            Device
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDevices }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas bi-display-fill fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Location Card -->
                    <div class="col-xl-4 mb-3">
                        <div class="card border-left-info shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <div class="text-sm font-weight-bold text-info text-uppercase">
                                            Location
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalLocations }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas bi-geo-alt-fill fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rack Card -->
                    <div class="col-xl-6 mb-3">
                        <div class="card border-left-warning shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase">
                                            Rack
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRacks }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas bi-inboxes-fill fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Software Card -->
                    <div class="col-xl-6 mb-3">
                        <div class="card border-left-danger shadow h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <div class="text-sm font-weight-bold text-danger text-uppercase">
                                            Software
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSoftwares }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas bi-motherboard-fill fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
