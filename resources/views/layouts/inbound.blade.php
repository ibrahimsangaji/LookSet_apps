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
                        <div style="border-bottom: 4px solid blue; width: 66%;"></div>
                    </a>
                </div>
                <div class="col-1" style="display: flex; align-items: center; justify-content: center;">
                    <div style="border-left: 2px solid black; height: 50px;"></div>
                </div>
                <div class="col-2">
                    <a href="/returns" style="text-decoration: none; color: black;">
                        <h3 class="font-weight-bold">Return</h3>
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

            <form method="post" action="{{ route('inbound.process') }}">
                @csrf
                <div class="mt-5 mb-3 row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name" placeholder="Insert Name" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputDevice" class="col-sm-2 col-form-label">Device</label>
                    <div class="col-sm-10">
                        <select name="device_id" id="inputDevice" class="form-select form-control" required>
                            <option value="" disabled selected>Select Device</option>
                            @foreach ($devices as $device)
                                <option value="{{ $device->id }}">{{ $device->name }}</option>
                            @endforeach
                        </select>
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
                    <label for="inputSoftware" class="col-sm-2 col-form-label">Software</label>
                    <div class="col-sm-10">
                        <select name="software_id" id="inputSoftware" class="form-select form-control">
                            <option value="" disabled selected>Select Software</option>
                            @foreach ($softwares as $software)
                                <option value="{{ $software->id }}">{{ $software->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-right mb-3">Add Inbound</button>
            </form>

        </div>
    </div>
@endsection
