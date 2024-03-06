@extends('tampilan')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow">

            <div class="mt-2 mr-5 card-header d-flex align-items-center">
                <h3 class="font-weight-bold text-primary">
                    <a href="/documents">Document</a>
                </h3>

                <h4 class="font-weight-bold text-primary ml-auto">
                    <a href="{{ route('download', $document->id) }}" target="_blank">
                        <i class="bi bi-download"></i>
                    </a>
                </h4>
            </div>

            @if ($document->conditions_id == 6)
                <div class="card-header text-center">
                    <h1 class="font-weight-bold text-primary">
                        {{ $document->condition->type }}
                    </h1>
                </div>

                <div class="container-fluid">
                    <div class="container">

                        <div class="mt-4 mb-3 row">
                            <label class="col-sm-2 col-form-label">Asset Number</label>
                            <div class="col-sm-10">
                                : {{ $document->asset_number }}
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                : {{ $document->name }}
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Device</label>
                            <div class="col-sm-10">
                                : {{ $document->device->name }}
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                : {{ $document->explanation }}
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Location</label>
                            <div class="col-sm-10">
                                : {{ $document->division->name }}
                            </div>
                        </div>


                        <div class="mt-5 py-5 d-flex justify-content-between">
                            <div class="col-2">
                                <div style="border-bottom: 2px solid black; width: 100%;"></div>
                                <p class="font-weight-bold text-center">
                                    {{ $document->pic }}
                                </p>
                            </div>
                            <div class="col-2">
                                <div style="border-bottom: 2px solid black; width: 100%;"></div>
                                <p class="font-weight-bold text-center">
                                    {{ $document->createdUser->name }}
                                </p>
                            </div>
                            <div class="col-2">
                                <div style="border-bottom: 2px solid black; width: 100%;"></div>
                                <p class="font-weight-bold text-center">
                                    {{ $document->approvalUser->name }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            @elseif ($document->conditions_id == 4)
                <div class="card-header text-center">
                    <h1 class="font-weight-bold text-primary">
                        @if ($document->condition)
                            {{ $document->condition->type }}
                        @endif
                    </h1>
                </div>

                <div class="container-fluid">
                    <div class="container">

                        <div class="mt-4 mb-3 row">
                            <label class="col-sm-2 col-form-label">Asset Number</label>
                            <div class="col-sm-10">
                                : {{ $document->asset_number }}
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                : {{ $document->name }}
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Device</label>
                            <div class="col-sm-10">
                                @if ($document->device)
                                    : {{ $document->device->name }}
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                : {{ $document->explanation }}
                            </div>
                        </div>

                        <div class="mt-5 py-5 d-flex justify-content-between">
                            <div class="col-2">
                                <div style="border-bottom: 2px solid black; width: 100%;"></div>
                                <p class="font-weight-bold text-center">
                                    {{ $document->createdUser->name }}
                                </p>
                            </div>
                            <div class="col-2">
                                <div style="border-bottom: 2px solid black; width: 100%;"></div>
                                <p class="font-weight-bold text-center">
                                    {{ $document->approvalUser->name }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            @elseif ($document->conditions_id == 5)
                <div class="card-header text-center">
                    <h1 class="font-weight-bold text-primary">
                        @if ($document->condition)
                            {{ $document->condition->type }}
                        @endif
                    </h1>
                </div>

                <div class="container-fluid">
                        <div class="container">

                            <div class="mt-4 mb-3 row">
                                <label class="col-sm-2 col-form-label">Asset Number</label>
                                <div class="col-sm-10">
                                    : {{ $document->asset_number }}
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    : {{ $document->name }}
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Device</label>
                                <div class="col-sm-10">
                                    @if ($document->device)
                                        : {{ $document->device->name }}
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    : {{ $document->explanation }}
                                </div>
                            </div>

                            <div class="mt-5 py-5 d-flex justify-content-between">
                                <div class="col-2">
                                    <div style="border-bottom: 2px solid black; width: 100%;"></div>
                                    <p class="font-weight-bold text-center">
                                        {{ $document->createdUser->name }}
                                    </p>
                                </div>
                                <div class="col-2">
                                    <div style="border-bottom: 2px solid black; width: 100%;"></div>
                                    <p class="font-weight-bold text-center">
                                        {{ $document->approvalUser->name }}
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
            @endif

        </div>
    </div>
@endsection
