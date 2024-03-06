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
        <li class="nav-item active">
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

                <!-- Tampilkan pesan sukses jika ada -->
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <!-- Tampilkan pesan error jika ada -->
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}

                        @if ($e = Session::get('exception'))
                            <br>
                            <small>{{ $e->getMessage() }}</small>
                        @endif
                    </div>
                @endif

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Location</h1>
                    <a href="/location/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Add Location
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Information</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $location)
                                    <tr>
                                        <td>{{ $location->name }}</td>
                                        <td>{{ $location->information }}</td>
                                        <td class="text-center">
                                            {{-- edit --}}
                                            <a href="{{ route('location.edit', $location->id) }}" class="btn btn-primary mr-4">
                                                <i class="bi bi-wrench-adjustable-circle-fill"></i>
                                            </a>
                                            {{-- delete --}}
                                            <button type="button" class="btn btn-danger text-link" data-toggle="modal" data-target="#rejectModal{{ $location->id }}">
                                                <i class="bi bi-x-circle-fill"></i>
                                            </button>

                                            <!-- Modal for Delete Confirmation -->
                                            <div class="modal fade" id="rejectModal{{ $location->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="rejectModalLabel">Delete Confirmation</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete location {{ $location->name }}?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <form method="post" action="{{ route('location.delete', $location->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
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
    </div>

</div>
@endsection
