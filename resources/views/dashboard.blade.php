@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
  <!-- Row -->
  <div class="row row-sm">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="card bg-primary img-card box-primary-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font">7,865</h2>
                                <p class="text-white mb-0">Total Followers </p>
                            </div>
                            <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- COL END -->
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="card bg-secondary img-card box-secondary-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font">86,964</h2>
                                <p class="text-white mb-0">Total Likes</p>
                            </div>
                            <div class="ms-auto"> <i class="fa fa-heart-o text-white fs-30 me-2 mt-2"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- COL END -->
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="card  bg-success img-card box-success-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font">98</h2>
                                <p class="text-white mb-0">Total Comments</p>
                            </div>
                            <div class="ms-auto"> <i class="fa fa-comment-o text-white fs-30 me-2 mt-2"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- COL END -->
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="card bg-info img-card box-info-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white">
                                <h2 class="mb-0 number-font">893</h2>
                                <p class="text-white mb-0">Total Posts</p>
                            </div>
                            <div class="ms-auto"> <i class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i> </div>
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
                                    <tr>
                                        <td>1</td>
                                        <td>Joan Powell</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-success btn-pill btn-sm">Active</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Gavin Gibson</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-pill btn-sm">Inactive</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Julian Kerr</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-success btn-pill btn-sm">Active</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Cedric Kelly</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-success btn-pill btn-sm">Active</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Samantha May</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-success btn-pill btn-sm">Active</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order Details</h3>
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
@push('js')
    <script>
        $('#recent-user-table').DataTable({
            language: {
                searchPlaceholder: 'Search...',
                scrollX: "100%",
                sSearch: '',
            }
        });
    </script>
@endpush
