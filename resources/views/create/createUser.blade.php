@extends('tampilan')

@section('content')
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="/catalog">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Nav Item - User -->
        <li class="nav-item active">
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
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Create User</h1>
                </div>

                <div>
                    @if ($errors->any())
                    <div class="mt-1 alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <form method="POST" action="{{ route('user.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select name="role" id="role" class="form-control" required>
                            <option class="text-secondary">-- Role --</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                            <option value="supervisor">Supervisor</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Add User</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
