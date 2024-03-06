<!DOCTYPE html>
<html>
<head>
    <title>{{ $condition }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        @page {
            size: A4;
        }

        .border-bottom-div {
            text-align: center;
            border-bottom: 2px solid black;
            width: 80%;
            margin: 0 auto;
        }
    </style>

</head>
<body>

    <p>{{ $date }}</p>

    <div class="card-header text-center" style="background-color: white;">
        <h1 class="font-weight-bold text-primary">
            {{ $condition }}
        </h1>
    </div>

    @if ($conditions_id === 6)
        <div class="card-header" style="background-color: white;">
            <div class="row g-3 align-items-center">
                <label class="col-sm-2 col-form-label">Asset Number</label>
                <label class="col-sm-5 col-form-label">: {{ $asset_number }}</label>
            </div>
            <div class="row g-3 align-items-center">
                <label class="col-sm-2 col-form-label">Name</label>
                <label class="col-sm-5 col-form-label">: {{ $name }}</label>
            </div>
            <div class="row g-3 align-items-center">
                <label class="col-sm-2 col-form-label">Device</label>
                <label class="col-sm-5 col-form-label">: {{ $device }}</label>
            </div>
            <div class="row g-3 align-items-center">
                <label class="col-sm-2 col-form-label">Description</label>
                <label class="col-sm-5 col-form-label">: {{ $explanation }}</label>
            </div>
            <div class="row g-3 align-items-center">
                <label class="col-sm-2 col-form-label">Location</label>
                <label class="col-sm-5 col-form-label">: {{ $division }}</label>
            </div>

            <div class="text-center mt-5 d-flex">
                <div class="row">
                    <table class="table pt-5">
                        <thead style="background-color: white;">
                            <tr>
                                <th>
                                    <div style="width: 50%; border-bottom: 2px solid black;; margin: auto;"></div>

                                </th>
                                <th>
                                    <div style="width: 50%; border-bottom: 2px solid black;; margin: auto;"></div>

                                </th>
                                <th>
                                    <div style="width: 50%; border-bottom: 2px solid black;; margin: auto;"></div>

                                </th>
                            </tr>
                        </thead>
                        <tbody style="background-color: white;">
                            <tr>
                                <th class="text-center">{{ $pic }}</th>
                                <th class="text-center">{{ $createdBy }}</th>
                                <th class="text-center">{{ $approvalBy }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    @else
        <div class="card-header" style="background-color: white;">
            <div class="row g-3 align-items-center">
                <label class="col-sm-2 col-form-label">Asset Number</label>
                <label class="col-form-label">: {{ $asset_number }}</label>
            </div>
            <div class="row g-3 align-items-center">
                <label class="col-sm-2 col-form-label">Name</label>
                <label class="col-form-label">: {{ $name }}</label>
            </div>
            <div class="row g-3 align-items-center">
                <label class="col-sm-2 col-form-label">Device</label>
                <label class="col-form-label">: {{ $device }}</label>
            </div>
            <div class="row g-3 align-items-center">
                <label class="col-sm-2 col-form-label">Description</label>
                <label class="col-form-label">: {{ $explanation }}</label>
            </div>

            <div class="text-center mt-5 d-flex">
                <div class="row">
                    <table class="table pt-5">
                        <thead style="background-color: white;">
                            <tr>
                                <th>
                                    <div style="width: 50%; border-bottom: 2px solid black;; margin: auto;"></div>

                                </th>
                                <th>
                                    <div style="width: 50%; border-bottom: 2px solid black;; margin: auto;"></div>

                                </th>
                            </tr>
                        </thead>
                        <tbody style="background-color: white;">
                            <tr>
                                <th class="text-center">{{ $createdBy }}</th>
                                <th class="text-center">{{ $approvalBy }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    @endif
</body>
</html>
