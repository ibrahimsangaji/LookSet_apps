<!doctype html>
<head>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('page') }}/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        @media print {
            @page {
                size: A4;
                margin: 0.5 0.5 0.5 0.5;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="card shadow">
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
                            <div class="col-2 mr-5">
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
                            <div class="col-2 mr-5">
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
                            <div class="col-2 mr-5">
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

    <script>
        // Function to be called when the document is ready
        document.addEventListener('DOMContentLoaded', function () {
            // Delay the print command for a short period to ensure the page has fully loaded
            setTimeout(function () {
                // Trigger the print command
                window.print();
            }, 1000); // You may need to adjust the delay based on your page load time
        });
    </script>
</body>
</html>

