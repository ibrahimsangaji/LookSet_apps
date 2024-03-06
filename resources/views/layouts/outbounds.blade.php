@extends('tampilan')

@section('content')
    <div class="container-fluid">
        <div class="container">

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

            <div class="row mt-5">
                <div class="col-2">
                    <a href="/outbounds" style="text-decoration: none; color: black;">
                        <h3 class="font-weight-bold">Outbound</h3>
                        <div style="border-bottom: 4px solid blue; width: 83%;"></div>
                    </a>
                </div>
            </div>

            @if ($errors->any())
                <div class="mt-2 alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('outbound.process') }}">
                @csrf
                <div class="mt-3 mb-3 row">
                    <label for="inputAssetNumber" class="col-sm-2 col-form-label">Asset Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputAssetNumber" name="asset_number" placeholder="Insert Asset Number (ASN-XXXXXX)" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputName" class="col-sm-2 col-form-label">Device</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputDevice" name="device" placeholder="Device" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="inputDescription" name="explanation" rows="3" placeholder="Description" readonly></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPIC" class="col-sm-2 col-form-label">PIC</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPIC" name="pic" placeholder="Insert PIC" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputLocation" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                        <select name="location_id" id="inputLocation" class="form-select form-control" required>
                            <option value="" disabled selected>Select Location</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-right mb-3">Add Outbound</button>
            </form>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            var currentAssetNumber = '';

            $('#inputAssetNumber').on('input', function () {
                var assetNumber = $(this).val();

                // Check if the input value has changed
                if (assetNumber !== currentAssetNumber) {
                    // Reset values to null
                    $('#inputName').val('');
                    $('#inputDevice').val('');
                    $('#inputDescription').val('');

                    // Update the currentAssetNumber
                    currentAssetNumber = assetNumber;

                    if (assetNumber !== '') {
                        $.ajax({
                            url: '{{ route('getDetailsOutbound') }}',
                            method: 'POST',
                            data: {asset_number: assetNumber, _token: '{{ csrf_token() }}'},
                            success: function (response) {
                                if (response) {
                                    // Set values if asset found
                                    $('#inputName').val(response.name);
                                    $('#inputDevice').val(response.device);
                                    $('#inputDescription').val(response.explanation);
                                }
                            },
                            error: function () {
                                console.log('Failed to get asset details.');
                            }
                        });
                    }
                }
            });
        });
    </script>
@endsection
