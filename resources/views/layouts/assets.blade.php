@extends('tampilan')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">

            <div class="card-header py-3 d-flex align-items-center">
                <h3 class="font-weight-bold text-primary">Assets</h3>

                @if($userRole == 'supervisor' || $userRole == 'admin')
                    <h3 class="font-weight-bold text-primary ml-auto">
                        <a href="/assets/delete">Delete</a>
                    </h3>
                @endif

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Asset Number</th>
                                <th>STO Number</th>
                                <th>Name</th>
                                <th>Device</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assets as $asset)
                                <tr>
                                    <td>{{ $asset->asset_number }}</td>
                                    <td>{{ $asset->sto_number }}</td>
                                    <td>{{ $asset->name }}</td>
                                    <td>{{ $asset->device->name }}</td>
                                    <td>{{ $asset->categorystatus->category }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
