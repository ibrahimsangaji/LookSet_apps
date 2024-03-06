@extends('tampilan')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">

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

            <div class="card-header py-3">
                <h3 class="font-weight-bold text-primary">Approval</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th class="text-center">Category</th>
                                <th class="px-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($outbounds as $outbound)
                                <tr>
                                    <td>{{ $outbound->sto_number }}</td>
                                    <td class="text-center">
                                        @if ($outbound->condition)
                                            {{ $outbound->condition->type }}
                                        @endif
                                    </td>
                                    @if ($outbound->conditions_id == 6)
                                        <td class="text-center">
                                            <button type="button" class="btn btn-success mr-3" data-toggle="modal" data-target="#approvalModal{{ $outbound->id }}">
                                                <i class="bi bi-check-circle-fill"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger mr-3" data-toggle="modal" data-target="#rejectModal{{ $outbound->id }}">
                                                <i class="bi bi-x-circle-fill"></i>
                                            </button>
                                            <a href="{{ route('approval.detailOutbound', $outbound->id) }}" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>

                                            <!-- Modal for Approval Confirmation -->
                                            <div class="modal fade" id="approvalModal{{ $outbound->id }}" tabindex="-1" role="dialog" aria-labelledby="approvalModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document" style="max-width: 37rem;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="approvalModalLabel">Approval Confirmation</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to Approved the number {{$outbound->sto_number}} request?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <form method="post" action="{{ route('approval.process', ['type' => 'outbounds', 'id' => $outbound->id]) }}">
                                                                @csrf
                                                                <input type="hidden" name="action" value="Approved">
                                                                <button type="submit" class="btn btn-success">Approved</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal for Reject Confirmation -->
                                            <div class="modal fade" id="rejectModal{{ $outbound->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document" style="max-width: 25rem;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="rejectModalLabel">Reject Confirmation</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to reject this approval?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <form method="post" action="{{ route('approval.process', ['type' => 'outbounds', 'id' => $outbound->id]) }}">
                                                                @csrf
                                                                <input type="hidden" name="action" value="Reject">
                                                                <button type="submit" class="btn btn-danger">Reject</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach

                            @foreach ($inbounds as $inbound)
                                <tr>
                                    <td>{{ $inbound->asset_number }}</td>
                                    <td class="text-center">
                                        @if ($inbound->condition)
                                            {{ $inbound->condition->type }}
                                        @endif
                                    </td>
                                    @if ($inbound->conditions_id == 4 || $inbound->conditions_id == 5)
                                        <td class="text-center">
                                            <button type="button" class="btn btn-success mr-3" data-toggle="modal" data-target="#approvalModal{{ $inbound->id }}">
                                                <i class="bi bi-check-circle-fill"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger mr-3" data-toggle="modal" data-target="#rejectModal{{ $inbound->id }}">
                                                <i class="bi bi-x-circle-fill"></i>
                                            </button>
                                            <a href="{{ route('approval.detailInbound', $inbound->id) }}" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>

                                            <!-- Modal for Approval Confirmation -->
                                            <div class="modal fade" id="approvalModal{{ $inbound->id }}" tabindex="-1" role="dialog" aria-labelledby="approvalModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document" style="max-width: 37rem;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="approvalModalLabel">Approval Confirmation</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to Approved the number {{$inbound->asset_number}} request?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <form method="post" action="{{ route('approval.process', ['type' => 'inbounds', 'id' => $inbound->id]) }}">
                                                                @csrf

                                                                <input type="hidden" name="action" value="Approved">
                                                                <button type="submit" class="btn btn-success">Approved</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>x
                                            </div>

                                            <!-- Modal for Reject Confirmation -->
                                            <div class="modal fade" id="rejectModal{{ $inbound->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document" style="max-width: 25rem;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="rejectModalLabel">Reject Confirmation</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to reject this approval?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <form method="post" action="{{ route('approval.process', ['type' => 'inbounds', 'id' => $inbound->id]) }}">
                                                                @csrf
                                                                <input type="hidden" name="action" value="Reject">
                                                                <button type="submit" class="btn btn-danger">Reject</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
