@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
  <!-- Row -->
  <div class="row row-sm">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-2">
                <div class="card bg-secondary img-card box-secondary-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font">{{ $pendingCount }}</h2>
                                <p class="text-white mb-0">Total Pending</p>
                            </div>
                            <div class="ms-auto"> <i class="fa fa-heart-o text-white fs-30 me-2 mt-2"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- COL END -->
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-2">
                <div class="card  bg-success img-card box-success-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font">{{ $assignedCount }}</h2>
                                <p class="text-white mb-0">Total Assigned</p>
                            </div>
                            <div class="ms-auto"> <i class="fa fa-comment-o text-white fs-30 me-2 mt-2"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- COL END -->
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-2">
                <div class="card  bg-success img-card box-success-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font">{{ $processingCount }}</h2>
                                <p class="text-white mb-0">Total Processing</p>
                            </div>
                            <div class="ms-auto"> <i class="fa fa-comment-o text-white fs-30 me-2 mt-2"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- COL END -->
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-2">
                <div class="card bg-info img-card box-info-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font">{{ $confirmedCount }}</h2>
                                <p class="text-white mb-0">Total Confirm</p>
                            </div>
                            <div class="ms-auto"> <i class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- COL END -->
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-2">
                <div class="card bg-primary img-card box-primary-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font">{{ $completedCount }}</h2>
                                <p class="text-white mb-0">Total Complete </p>
                            </div>
                            <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- COL END -->
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Recent User</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border text-nowrap text-center text-md-nowrap table-bordered mb-0" id="recent-user-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Primary Full Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($recentUsers) > 0)
                                        @foreach($recentUsers as $key=>$value)
                                            <tr>
                                                <td>{{ $key }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-success btn-pill btn-sm">Active</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header align-content-center justify-content-between">
                        <h3 class="card-title">Order Details</h3>
                        <input type="text" id="datepicker" name="datepicker" size="30" readonly>
                    </div>
                    <div class="card-body">
                        <div id="chartdiv"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->
@endsection
@push('css')

@endpush
@push('js')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        const currentDate = new Date();
        var chart;
        var series;
        var legend;
        $( "#datepicker" ).datepicker({
            maxDate: currentDate,
            defaultDate: currentDate,
            dateFormat: "yy-mm-dd"
        });
        $("#datepicker").val($.datepicker.formatDate("yy-mm-dd", currentDate));
        $('#recent-user-table').DataTable({
            language: {
                searchPlaceholder: 'Search...',
                scrollX: "100%",
                sSearch: '',
            }
        });

    <!-- Chart code -->
        am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv");

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            // Create chart
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
            chart = root.container.children.push(am5percent.PieChart.new(root, {
                radius: am5.percent(90),
                innerRadius: am5.percent(50),
                layout: root.horizontalLayout
            }));

            // Create series
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
            series = chart.series.push(am5percent.PieSeries.new(root, {
                name: "Series",
                valueField: "sales",
                categoryField: "country"
            }));

            // Set data
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
            series.data.setAll([{
                country: "Confirm Order",
                sales: 0
            }, {
                country: "Processing Order",
                sales: 0
            }, {
                country: "Delivered Order",
                sales: 0
            }, {
                country: "Pending Order",
                sales: 0
            }]);

            // Disabling labels and ticks
            series.labels.template.set("visible", false);
            series.ticks.template.set("visible", false);

            // Adding gradients
            series.slices.template.set("strokeOpacity", 0);
            series.slices.template.set("fillGradient", am5.RadialGradient.new(root, {
                stops: [{
                    brighten: -0.8
                }, {
                    brighten: -0.8
                }, {
                    brighten: -0.5
                }, {
                    brighten: 0
                }, {
                    brighten: -0.5
                }]
            }));

            // Create legend
            // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
            legend = chart.children.push(am5.Legend.new(root, {
                centerY: am5.percent(50),
                y: am5.percent(50),
                layout: root.verticalLayout
            }));
            // set value labels align to right
            legend.valueLabels.template.setAll({
                textAlign: "bottom"
            })
            // set width and max width of labels
            legend.labels.template.setAll({
                maxWidth: 140,
                width: 140,
                oversizedBehavior: "wrap",
            });

            legend.data.setAll(series.dataItems);


            // Play initial series animation
            // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
            series.appear(1000, 100);

        }); // end am5.ready()

        function updateChartData(data) {
            series.data.setAll(data);
            legend.data.setAll(series.dataItems);
            series.appear(1000, 100);
        }

        function getDateWiseRecord(selectedDate) {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Make an AJAX API call with the selectedDate
            $.ajax({
                url: '{{ route("orders.detail.chart") }}', // Replace with your API endpoint
                type: "POST", // Change to the appropriate HTTP method (GET, POST, etc.)
                data: { date: selectedDate }, // Pass the selected date as a parameter
                dataType: 'json', // Expected data type of the response
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                },
                success: function(response) {
                    // Handle the API response here
                    const orderDetail = response.data
                    var newData = [
                        {
                            country: "Confirm Order",
                            sales: orderDetail.confirm
                        },
                        {
                            country: "Processing Order",
                            sales: orderDetail.processing
                        },
                        {
                            country: "Delivered Order",
                            sales: orderDetail.completed
                        },
                        {
                            country: "Pending Order",
                            sales: orderDetail.pending
                        },
                    ];
                    updateChartData(newData);
                },
                error: function(error) {
                    // Handle any errors here
                    console.error(error);
                }
            });
        }


        $("#datepicker").on("change", function() {
            // Get the selected date
            const selectedDate = $.datepicker.formatDate("yy-mm-dd", $(this).datepicker("getDate"));
            getDateWiseRecord(selectedDate)
        });
        setTimeout(()=>{
            const selectedDate = $.datepicker.formatDate("yy-mm-dd", $("#datepicker").datepicker("getDate"));
            console.log(selectedDate)
            getDateWiseRecord(selectedDate)
        },200)
    </script>
@endpush
