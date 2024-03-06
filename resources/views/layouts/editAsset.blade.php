@extends('tampilan')

@section('content')
    <div class="container-fluid">
        <div class="container">

            <div class="card-header py-3 text-center">
                <h1 class="mt-5 font-weight-bold text-primary">{{ $data->asset_number }}</h1>
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

            <form method="post" action="{{ route('asset.update', $data->id) }}">
                @csrf
                @method('PUT')
                <div class="mt-5 mb-3 row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name" value="{{ $data->name }}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputDevice" class="col-sm-2 col-form-label">Device</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputDevice" name="device" value="{{ $data->device->name }}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="inputDescription" name="explanation" rows="3" placeholder="{{ $data->explanation }}"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-right mt-4 mb-3">Update Data</button>
            </form>

        </div>
    </div>
@endsection
