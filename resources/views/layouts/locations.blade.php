@extends('tampilan')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                @if(auth()->user()->role == 'supervisor')
                    <h3 class="font-weight-bold text-primary">Document</h3>
                @endif
                @if(auth()->user()->role == 'staff' || auth()->user()->role == 'admin')
                    <h3 class="font-weight-bold text-primary">Locations</h3>
                @endif
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Location Number</th>
                                <th>Name Location</th>
                                <th class="text-center">Sum Goods</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupedInlocations as $locNumber => $group)
                                <tr>
                                    <td>{{ $locNumber }}</td>
                                    <td>{{ $group->first()->outbound->division->information }}</td>
                                    <td class="text-center">{{ $group->count() }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('locations.index', $locNumber) }}" class="btn btn-primary">
                                            <i class="bi bi-eye-fill"></i>
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
