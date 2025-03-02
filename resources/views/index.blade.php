@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat boxes) -->
            <div class="row">
                <!-- Total Calls -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $callCount }}</h3>
                            <p>Total Calls</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('call-list') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Agents -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $agentCount }}</h3>
                            <p>Total Agents</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('agents-list') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>
                            <p>Total Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Visitors -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>
                            <p>Total Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- /.row -->

            <!-- Chart row -->
            <div class="row">
                <!-- Pie Chart for Orders, Calls, Revenue, Loss -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Orders, Calls, Revenue & Loss</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Bar Chart for Popular Product -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Popular Products</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="barChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interactive Chart -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="far fa-chart-bar"></i>
                        Interactive Area Chart
                    </h3>
                    <div class="card-tools">
                        Real time
                        <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                            <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="interactive" style="height: 300px;"></div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        // Flot Interactive Chart
        var data = [],
            totalPoints = 100;

        function getRandomData() {
            if (data.length > 0) {
                data = data.slice(1);
            }

            // Generate random walk data
            while (data.length < totalPoints) {
                var prev = data.length > 0 ? data[data.length - 1] : 50;
                var y = prev + Math.random() * 10 - 5;

                if (y < 0) {
                    y = 0;
                } else if (y > 100) {
                    y = 100;
                }

                data.push(y);
            }

            var res = [];
            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i]]);
            }

            return res;
        }

        var interactivePlot = $.plot('#interactive', [{
            data: getRandomData(),
        }], {
            grid: {
                borderColor: '#f3f3f3',
                borderWidth: 1,
                tickColor: '#f3f3f3',
            },
            series: {
                color: '#3c8dbc',
                lines: {
                    lineWidth: 2,
                    show: true,
                    fill: true,
                },
            },
            yaxis: {
                min: 0,
                max: 100,
                show: true,
            },
            xaxis: {
                show: true,
            },
        });

        var updateInterval = 500; // Update every x milliseconds
        var realtime = 'on';

        function update() {
            interactivePlot.setData([getRandomData()]);
            interactivePlot.draw();
            if (realtime === 'on') {
                setTimeout(update, updateInterval);
            }
        }

        // Initialize real-time data fetching
        if (realtime === 'on') {
            update();
        }

        // Real-time toggle functionality
        $('#realtime .btn').click(function() {
            if ($(this).data('toggle') === 'on') {
                realtime = 'on';
            } else {
                realtime = 'off';
            }
            update();
        });

        // Pie Chart for Orders, Calls, Revenue, Loss
        var ctx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Orders', 'Calls', 'Revenue', 'Loss'],
                datasets: [{
                    label: 'Stats Distribution',
                    data: [300, 150, 120, 90], // Example data for Orders, Calls, Revenue, Loss
                    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
                    borderColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
                    borderWidth: 1,
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
            },
        });

        // Bar Chart for Popular Products
        var barCtx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Product A', 'Product B', 'Product C', 'Product D', 'Product E'], // Example product labels
                datasets: [{
                    label: 'Popular Products',
                    data: [45, 60, 70, 90, 50], // Example product sales data
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    borderWidth: 1,
                }],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    </script>
@endsection
