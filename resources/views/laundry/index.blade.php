@extends('layouts.app')

@section('title', 'Category')
@section('page-header')
    <a data-bs-toggle="modal" data-bs-target="#largemodal">
        <button type="button" class="btn btn-primary">
            <i class="fe fe-plus me-2"></i> Add Category
        </button>
    </a>
@endsection
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered text-nowrap border-bottom text-center"
                           id="responsive-datatable">
                        <thead>
                        <tr>
                            <th>SR. NO.</th>
                            <th>CATEGORY NAME</th>
                            <th> TYPE </th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($laundry) > 0)
                            @foreach($laundry as $key=>$value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->types->name }}</td>
                                    <td>
                                        @if($value->status)
                                            <a href="javascript:void(0)"
                                               class="btn btn-success btn-pill btn-sm">Active</a>
                                        @else
                                            <a href="javascript:void(0)"
                                               class="btn btn-danger btn-pill btn-sm">Inactive</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a onclick="onEdit({{ $value->id }})" class="btn btn-info  btn-pill btn-sm">Edit</a>
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
    <!-- End Row -->

    <!-- Add New Category Modal -->
       <div class="modal fade" id="largemodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Laundry</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form id="add-new-user" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">CATEGORY NAME <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Company name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">TYPE</label>
                                <select name="type_id" class="form-control form-select select2" data-bs-placeholder="Select Country">
                                    @foreach($types as $type)
                                        <option value={{ $type->id  }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button onclick="onSubmit()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Add New Category Modal End -->

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Laundry</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editmodal-categories" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">CATEGORY NAME <span class="text-red">*</span></label>
                                    <input type="hidden" class="form-control" id="category_id" name="category_id" placeholder="Company name">
                                    <input type="text" class="form-control" id="category_name" name="name" placeholder="Company name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">TYPE</label>
                                    <select name="type_id" class="form-control form-select select2" data-bs-placeholder="Select Country" id="type_id">
                                        @foreach($types as $type)
                                            <option value={{ $type->id  }}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button onclick="onUpdate()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Category Modal End -->
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
                url: '{{ route('category.store') }}', // URL of the endpoint you defined
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
                    // window.location.reload();
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

        function onUpdate() {
            const formData = $('#editmodal-categories').serializeArray();
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/admin/category/'+ $("#category_id").val(), // URL of the endpoint you defined
                type: 'PUT', // or 'POST', 'PUT', etc.
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

        function onEdit(id) {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/admin/category/' + id + '/edit',
                type: 'GET',
                dataType: 'json', // Expected data type of the response
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                },
                success: function(response) {
                    // Handle the response
                    $('#category_name').val(response.data?.name);
                    $('#type_id').val(response.data?.types?.id);
                    $("#category_id").val(response.data?.id)
                    toastr.success(response.message);
                    $('#editmodal').modal('show');
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
