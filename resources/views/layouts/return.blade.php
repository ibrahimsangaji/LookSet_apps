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
                    <a href="/inbounds" style="text-decoration: none; color: black;">
                        <h3 class="font-weight-bold">Inbound</h3>
                    </a>
                </div>
                <div class="col-1" style="display: flex; align-items: center; justify-content: center;">
                    <div style="border-left: 2px solid black; height: 50px;"></div>
                </div>
                <div class="col-2">
                    <a href="/returns" style="text-decoration: none; color: black;">
                        <h3 class="font-weight-bold">Return</h3>
                        <div style="border-bottom: 4px solid blue; width: 55%;"></div>
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

            <form method="post" action="{{ route('return.process') }}">
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
                    <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="inputDescription" name="description" rows="3" placeholder="Insert Description"></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputRack" class="col-sm-2 col-form-label">Rack</label>
                    <div class="col-sm-10">
                        <select name="rack_id" id="inputRack" class="form-select form-control" required>
                            <option value="" disabled selected>Select Rack</option>
                            @foreach ($racks as $rack)
                                <option value="{{ $rack->id }}">{{ $rack->explanation }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status_id" id="inputStatus" class="form-select form-control" required>
                            <option value="" disabled selected>Select Status</option>
                            @foreach ($statuss as $status)
                                @if ($status->id >= 5 && $status->id <= 7)
                                    <option value="{{ $status->id }}">{{ $status->category }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-right mb-3">Process Return</button>
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
                    $('#inputDescription').val('');

                    // Update the currentAssetNumber
                    currentAssetNumber = assetNumber;

                    if (assetNumber !== '') {
                        $.ajax({
                            url: '{{ route('getDetailsReturn') }}',
                            method: 'POST',
                            data: {asset_number: assetNumber, _token: '{{ csrf_token() }}'},
                            success: function (response) {
                                if (response) {
                                    // Set values if asset found
                                    $('#inputName').val(response.name);
                                    $('#inputDescription').val(response.description);
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
