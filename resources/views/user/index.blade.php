@extends('layouts.app')

@section('title', 'User List')
@section('page-header')
    <a data-bs-toggle="modal" data-bs-target="#largemodal">
        <button type="button" class="btn btn-primary">
            <i class="fe fe-plus me-2"></i> Add New User
        </button>
    </a>
@endsection
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="panel panel-primary">
                        <div class="tab-menu-heading tab-menu-heading-boxed">
                            <div class="tabs-menu-boxed">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs" role="tablist">
                                    <li><a href="#tab25" class="active" data-bs-toggle="tab" aria-selected="true"
                                            role="tab">Captain</a></li>
                                    <li><a href="#tab26" data-bs-toggle="tab" aria-selected="false" role="tab"
                                            class="" tabindex="-1">User</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tab25" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-nowrap border-bottom text-center"
                                            id="responsive-datatable">
                                            <thead>
                                                <tr>
                                                    <th class="wd-15p border-bottom-0">Captain ID</th>
                                                    <th class="wd-15p border-bottom-0">Captain Name</th>
                                                    <th class="wd-20p border-bottom-0">Mobile No.</th>
                                                    <th class="wd-15p border-bottom-0">Status</th>
                                                    <th class="wd-10p border-bottom-0">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($captainUsersList))
                                                @foreach($captainUsersList as $key=>$value)
                                                    <tr>
                                                        <td>{{ $value->id }}</td>
                                                        <td>{{ $value->name }}</td>
                                                        <td>{{ $value->mobile }}</td>
                                                        <td>
                                                            @if($value->status === 'Active')
                                                                <a href="javascript:void(0)"
                                                                   class="btn btn-success btn-pill btn-sm">{{ $value->status }}</a>
                                                            @else
                                                                <a href="javascript:void(0)"
                                                                   class="btn btn-danger btn-pill btn-sm">Inactive</a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-primary btn-pill">View</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab26" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-nowrap border-bottom text-center"
                                            id="basic-datatable">
                                            <thead>
                                                <tr>
                                                    <th class="wd-15p border-bottom-0">User ID</th>
                                                    <th class="wd-15p border-bottom-0">User Name</th>
                                                    <th class="wd-20p border-bottom-0">Mobile No.</th>
                                                    <th class="wd-15p border-bottom-0">Status</th>
                                                    <th class="wd-10p border-bottom-0">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($usersList) > 0)
                                                @foreach($usersList as $value)
                                                    <tr>
                                                        <td>{{ $value->id }}</td>
                                                        <td>{{ $value->name }}</td>
                                                        <td>{{ $value->mobile }}</td>
                                                        <td>
                                                            @if($value->status === 'Active')
                                                                <a href="javascript:void(0)"
                                                                   class="btn btn-success btn-pill btn-sm">{{ $value->status }}</a>
                                                            @else
                                                                <a href="javascript:void(0)"
                                                                   class="btn btn-danger btn-pill btn-sm">Inactive</a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-primary btn-pill">View</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

       <!-- Modal -->
       <div class="modal fade" id="largemodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="add-new-user" method="POST">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label class="form-label">User  <span class="text-red">*</span></label>
                                    <div class="custom-controls-stacked">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <label class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="role" value="captain" checked="">
                                                    <span class="custom-control-label">Captain</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <label class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="role" value="user">
                                                    <span class="custom-control-label">User</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">First Name <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" name="first_name" placeholder="First name">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email" autocomplete="username">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label>Mobile Number :</label>
                                    <input type="text" name="mobile" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label>Alternet Mobile Number :</label>
                                    <input type="text" name="alternative_mobile" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Last Name <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" name="last_name" placeholder="Last name">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button onclick="onSubmit()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->
@endsection

@push('js')
    <script>
        $('#responsive-datatable').DataTable({
            language: {
                searchPlaceholder: 'Search...',
                scrollX: "100%",
                sSearch: '',
            },

        });
        function onSubmit() {
            const formData = $('#add-new-user').serializeArray();
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route('users.store') }}', // URL of the endpoint you defined
                type: 'POST', // or 'POST', 'PUT', etc.
                data: formData,
                dataType: 'json', // Expected data type of the response
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                },
                success: function(response) {
                    // Handle the response
                    toastr.success(response.message);
                    $('#largemodal').modal('hide');
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        showToasts(errors);
                    } else {
                        console.error(error);
                    }
                }

            });

        }
    </script>
@endpush
