@extends('layouts.app')

@section('title', 'Laudry')
@section('page-header')
    <a data-bs-toggle="modal" data-bs-target="#largemodal">
        <button type="button" class="btn btn-primary">
            <i class="fe fe-plus me-2"></i> Add New Laudry
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
                            <th class="wd-15p border-bottom-0">ID</th>
                            <th class="wd-15p border-bottom-0">Name</th>
                            <th class="wd-20p border-bottom-0">Price</th>
                            <th class="wd-15p border-bottom-0">Status</th>
                            <th class="wd-10p border-bottom-0">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($laundry) > 0)
                            @foreach($laundry as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->price }}</td>
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
                                        <form action="{{ route('laundry.destroy', $value->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-pill">Delete</button>
                                        </form>
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
                    <h5 class="modal-title">Add New Laundry</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="add-new-user" method="POST">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Name <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label>Price :</label>
                                    <input type="number" name="price" class="form-control">
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
                url: '{{ route('laundry.store') }}', // URL of the endpoint you defined
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
