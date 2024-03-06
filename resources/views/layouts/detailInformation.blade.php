@extends('tampilan')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow">

            <div class="mt-5 card-header d-flex align-items-center">
                <h4 class="font-weight-bold text-primary ml-auto">
                </h4>
            </div>

            <div class="card-header text-center py-3">
                <h1 class="font-weight-bold text-primary">
                    Detail Information
                </h1>
            </div>

            <div class="container-fluid">
                <div class="container">

                    <div class="mt-3 mb-3 row">
                        <label class="col-sm-2 col-form-label">Asset Number</label>
                        <div class="col-sm-10">
                            : {{ $data->outbound->asset->asset_number }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            : {{ $data->name }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Device</label>
                        <div class="col-sm-10">
                            : {{ $data->device->name }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            : {{ $data->outbound->asset->explanation }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">PIC</label>
                        <div class="col-sm-10">
                            : {{ $data->outbound->pic }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Condition</label>
                        <div class="col-sm-10">
                            : {{ $data->outbound->condition->type }}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
