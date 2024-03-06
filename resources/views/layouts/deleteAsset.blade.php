@extends('tampilan')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">

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
                </div>
            @endif

            <div class="card-header py-3 d-flex align-items-center">
                <h3 class="font-weight-bold text-primary">Delete Assets</h3>

                @if($userRole == 'supervisor' || $userRole == 'admin')
                    <h3 class="font-weight-bold text-primary ml-auto">
                        <a href="/assets">Assets</a>
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
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assets as $asset)
                                <tr>
                                    <td>{{ $asset->asset_number }}</td>
                                    <td>{{ $asset->sto_number }}</td>
                                    <td>{{ $asset->name }}</td>
                                    <td>{{ $asset->device->name }}</td>
                                    <td>
                                        @if($asset->inbound->approval_status == 'Approved')
                                            {{ $asset->categorystatus->category }}
                                        @else
                                            {{ $asset->inbound->approval_status }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($asset->category_statuses_id == 6)
                                            {{-- edit --}}
                                            <a href="{{ route('asset.edit', $asset->id) }}" class="btn btn-primary mr-2">
                                                <i class="bi bi-wrench-adjustable-circle-fill"></i>
                                            </a>
                                        @endif

                                        {{-- delete --}}
                                        <button type="button" class="btn btn-danger text-link" data-toggle="modal" data-target="#rejectModal{{ $asset->id }}">
                                            <i class="bi bi-x-circle-fill"></i>
                                        </button>

                                        <!-- Modal for Delete Confirmation -->
                                        <div class="modal fade" id="rejectModal{{ $asset->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="rejectModalLabel">Delete Confirmation</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete assets based on asset number {{ $asset->asset_number }}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <form method="post" action="{{ route('asset.delete', $asset->id) }}">
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
@endsection
