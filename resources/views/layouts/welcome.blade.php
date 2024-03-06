@extends('tampilan')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid mt-5">
    <div class="row d-flex justify-content-center mb-5">

        <!--Amount Card-->
        <div class="col-md-2 mb-3">
            <div class="card border-left-primary shadow">
                <div class="card-body">
                    <div class="chart-pie">
                        <canvas id="myPieChartAmount"></canvas>
                    </div>
                    <div class="text-center small">
                        <span class="me-2">
                            <i class="fas fa-circle text-primary"></i> Amount
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inbound Card -->
        <div class="col-md-2 mb-3">
            <div class="card border-left-success shadow">
                <div class="card-body">
                    <div class="chart-pie">
                        <canvas id="myPieChartInbound"></canvas>
                    </div>
                    <div class="text-center small">
                        <span class="me-2">
                            <i class="fas fa-circle text-success"></i> Inbound
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Outbound Card -->
        <div class="col-md-2 mb-3">
            <div class="card border-left-info shadow">
                <div class="card-body">
                    <div class="chart-pie">
                        <canvas id="myPieChartOutbound"></canvas>
                    </div>
                    <div class="text-center small">
                        <span class="me-2">
                            <i class="fas fa-circle text-info"></i> Outbound
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Repair Card -->
        <div class="col-md-2 mb-3">
            <div class="card border-left-warning shadow">
                <div class="card-body">
                    <div class="chart-pie">
                        <canvas id="myPieChartRepair"></canvas>
                    </div>
                    <div class="text-center small">
                        <span>
                            <i class="fas fa-circle text-warning"></i> Repair
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lost Card -->
        <div class="col-md-2 mb-3">
            <div class="card border-left-danger shadow">
                <div class="card-body">
                    <div class="chart-pie">
                        <canvas id="myPieChartLost"></canvas>
                    </div>
                    <div class="text-center small">
                        <span>
                            <i class="fas fa-circle text-danger"></i> Lost
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container">
    @if (Auth::user()->role == 'admin')
        @include('menu.admin')
    @endif
    @if (Auth::user()->role == 'staff')
        @include('menu.staff')
    @endif
    @if (Auth::user()->role == 'supervisor')
        @include('menu.supervisor')
    @endif
</div>

<script>
    var totalAssets = {{ $totalAssets }};
    var totalInbound = {{ $totalInbound }};
    var totalOutbound = {{ $totalOutbound }};
    var totalRepair = {{ $totalRepair }};
    var totalLost = {{ $totalLost }};
</script>
@endsection
