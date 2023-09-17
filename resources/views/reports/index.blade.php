@extends('layouts.app')

@section('title', 'Reports')
@section('content')
    <!-- ROW-2 -->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sales Analytics</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex mx-auto text-center justify-content-center mb-4">
                        <div class="d-flex text-center justify-content-center me-3"><span
                                class="dot-label bg-primary my-auto"></span>Total Sales</div>
                        <div class="d-flex text-center justify-content-center"><span
                                class="dot-label bg-secondary my-auto"></span>Total Orders</div>
                    </div>
                    <div class="chartjs-wrapper-demo">
                        <canvas id="transactions-report" class="chart-dropshadow"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
    </div>
    <!-- ROW-2 END -->
@endsection

@push('js')
<script>
    // TRANSACTIONS
    var $orders = @json($orders);
    var $totalSales = @json($totalSales);
    $(document).ready(function () {
        var myCanvas = document.getElementById("transactions-report");
        myCanvas.height = "330";
        var myCanvasContext = myCanvas.getContext("2d");
        var gradientStroke1 = myCanvasContext.createLinearGradient(0, 80, 0, 280);
        gradientStroke1.addColorStop(0, 'rgba(108, 95, 252, 0.8)');
        gradientStroke1.addColorStop(1, 'rgba(108, 95, 252, 0.2) ');

        var gradientStroke2 = myCanvasContext.createLinearGradient(0, 80, 0, 280);
        gradientStroke2.addColorStop(0, 'rgba(5, 195, 251, 0.8)');
        gradientStroke2.addColorStop(1, 'rgba(5, 195, 251, 0.2) ');
        document.getElementById('transactions-report').innerHTML = '';
        var myChart;

        myChart = new Chart(myCanvas, {

            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
                type: 'line',
                datasets: [{
                    label: 'Total Orders',
                    data: $orders,
                    backgroundColor: gradientStroke1,
                    borderColor: "#05c3fb",
                    pointBackgroundColor: '#fff',
                    pointHoverBackgroundColor: gradientStroke1,
                    pointBorderColor: "#05c3fb",
                    pointHoverBorderColor: gradientStroke1,
                    pointBorderWidth: 0,
                    pointRadius: 0,
                    pointHoverRadius: 0,
                    borderWidth: 3,
                    fill: 'origin',
                    lineTension: 0.3
                }, {
                    label: 'Total Orders',
                    data: $totalSales,
                    backgroundColor: 'transparent',
                    borderColor: "#05c3fb",
                    pointBackgroundColor: '#fff',
                    pointHoverBackgroundColor: gradientStroke2,
                    pointBorderColor: "#05c3fb",
                    pointHoverBorderColor: gradientStroke2,
                    pointBorderWidth: 0,
                    pointRadius: 0,
                    pointHoverRadius: 0,
                    borderWidth: 3,
                    fill: 'origin',
                    lineTension: 0.3

                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                        labels: {
                            usePointStyle: false,
                        }
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                scales: {
                    x: {
                        display: true,
                        grid: {
                            display: false,
                            drawBorder: false,
                            color: 'rgba(119, 119, 142, 0.08)'
                        },
                        ticks: {
                            autoSkip: true,
                            color: '#b0bac9'
                        },
                        scaleLabel: {
                            display: false,
                            labelString: 'Month',
                            fontColor: 'transparent'
                        }
                    },
                    y: {
                        ticks: {
                            min: 0,
                            max: 1050,
                            stepSize: 150,
                            color: "#b0bac9",
                        },
                        display: true,
                        grid: {
                            display: true,
                            drawBorder: false,
                            zeroLineColor: 'rgba(142, 156, 173,0.1)',
                            color: "rgba(142, 156, 173,0.1)",
                        },
                        scaleLabel: {
                            display: false,
                            labelString: 'sales',
                            fontColor: 'transparent'
                        }
                    }
                },
                title: {
                    display: false,
                    text: 'Normal Legend'
                }
            }
        });
    })
</script>
@endpush
