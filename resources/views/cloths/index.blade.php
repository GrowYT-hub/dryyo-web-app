@extends('layouts.app')

@section('title', 'Sub-Category')
@section('page-header')
    <a data-bs-toggle="modal" data-bs-target="#largemodal">
        <button type="button" class="btn btn-primary">
            <i class="fe fe-plus me-2"></i> Add Sub-Category
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
                            <th>Sr. No.</th>
                            <th>Sub-category Name</th>
                            <th>Category Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($laundry) > 0)
                            @foreach($laundry as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->categories->name }}</td>
                                    <td>{{ $value->categories->types->name }}</td>
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
                                        <form action="{{ route('sub-category.destroy', $value->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-pill">Delete</button>
                                        </form>
                                        <a onclick="onEdit({{ $value->id }})"
                                           class="btn btn-info btn-pill">Edit</a>
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

    <!-- Modal -->
    <div class="modal fade" id="largemodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ADD CATEGORY</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-new-sub-categories" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">SUB-CATEGORY NAME <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Company name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">CATEGORY NAME</label>
                                    <select name="category_id" class="form-control form-select select2"
                                            data-bs-placeholder="Select Country">
                                        @foreach($categories as $category)
                                            <option value={{ $category->id  }}>{{ $category->name  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Washing Price<span class="text-red">*</span></label>
                                    <input type="number" name="washing_price" class="form-control"
                                           placeholder="Washing Price"/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Iron Price <span class="text-red">*</span></label>
                                    <input type="number" name="iron_price" class="form-control"
                                           placeholder="Iron Price"/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Dry Cleaning Price<span class="text-red">*</span></label>
                                    <input type="number" name="dry_cleaning_price" class="form-control"
                                           placeholder="Dry Cleaning Price"/>
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
    <!-- Modal End -->

    <!-- Edit Sub Category Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Sub Category</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editmodal-categories" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">SUB-CATEGORY NAME <span class="text-red">*</span></label>
                                    <input type="hidden" class="form-control" id="sub_category_id" name="sub_category_id" placeholder="Company name">
                                    <input type="text" class="form-control" name="name" id="sub_category_name" placeholder="Company name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">CATEGORY NAME</label>
                                    <select name="category_id" class="form-control form-select select2"
                                            data-bs-placeholder="Select Country" id="category_id">
                                        @foreach($categories as $category)
                                            <option value={{ $category->id  }}>{{ $category->name  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Washing Price<span class="text-red">*</span></label>
                                    <input type="number" name="washing_price" class="form-control"
                                           placeholder="Washing Price" id="washing_price"/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Iron Price <span class="text-red">*</span></label>
                                    <input type="number" name="iron_price" id="iron_price" class="form-control"
                                           placeholder="Iron Price"/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Dry Cleaning Price<span class="text-red">*</span></label>
                                    <input type="number" name="dry_cleaning_price" id="dry_cleaning_price" class="form-control"
                                           placeholder="Dry Cleaning Price"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button onclick="onUpdate()" class="btn btn-primary">Update changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Sub Category Modal End -->
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
            const formData = $('#add-new-sub-categories').serializeArray();
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route('sub-category.store') }}', // URL of the endpoint you defined
                type: 'POST', // or 'POST', 'PUT', etc.
                data: formData,
                dataType: 'json', // Expected data type of the response
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                },
                success: function (response) {
                    // Handle the response
                    toastr.success(response.message);
                    setTimeout(()=>{
                        $('#largemodal').modal('hide');
                        window.location.reload();
                    },500)
                },
                error: function (xhr, status, error) {
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
                url: '/admin/sub-category/' + $("#sub_category_id").val(),
                type: 'PUT',
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    // Handle the response
                    toastr.success(response.message);
                    $('#largemodal').modal('hide');
                    window.location.reload();
                },
                error: function (xhr, status, error) {
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
                url: '/admin/sub-category/' + id + '/edit',
                type: 'GET',
                dataType: 'json', // Expected data type of the response
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                },
                success: function (response) {
                    // Handle the response
                    $('#sub_category_name').val(response.data?.name);
                    $('#sub_category_id').val(response.data?.id);
                    $('#category_id').val(response.data?.categories?.id);
                    $('#washing_price').val(response.data?.washing_price);
                    $('#iron_price').val(response.data?.iron_price);
                    $('#dry_cleaning_price').val(response.data?.dry_cleaning_price);
                    toastr.success(response.message);
                    $('#editmodal').modal('show');
                },
                error: function (xhr, status, error) {
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
