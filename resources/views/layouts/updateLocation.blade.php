@extends('tampilan')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">

            <div class="card-header py-3 d-flex align-items-center">
                <h3 class="font-weight-bold text-primary">Update</h3>

                <h3 class="font-weight-bold text-primary ml-auto">
                    <a href="{{ route('locations.index', ['location' => $dataLoc->loc_number]) }}">Detail</a>
                </h3>
            </div>

            <div class="card-header py-3 text-center">
                <h5 class="m-0 font-weight-bold text-primary">
                    {{ $dataLoc->outbound->division->name }}
                </h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Asset Number</th>
                                <th>Name</th>
                                <th>Device</th>
                                <th>PIC</th>
                                <th>Condition</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inlocation as $data)
                                <tr>
                                    <td>{{ $data->outbound->asset->asset_number }}</td>
                                    <td>{{ $data->outbound->name }}</td>
                                    <td>{{ $data->outbound->asset->device->name }}</td>
                                    <td>{{ $data->outbound->pic }}</td>
                                    <td>{{ $data->outbound->condition->type }}</td>
                                    <td class="text-center">
                                        {{-- edit --}}
                                        <a href="{{ route('locations.edit', ['location' => $data->loc_number, 'id' => $data->outbound->id]) }}" class="btn btn-primary mr-4">
                                            <i class="bi bi-wrench-adjustable-circle-fill"></i>
                                        </a>
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
