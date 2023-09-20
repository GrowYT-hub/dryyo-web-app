@extends('layouts.app')

@section('title', 'Orders')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap text-center border-bottom" id="responsive-datatable">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">Order ID</th>
                                <th class="wd-15p border-bottom-0">Customer</th>
                                <th class="wd-20p border-bottom-0">Date</th>
                                <th class="wd-15p border-bottom-0">Address</th>
                                <th class="wd-15p border-bottom-0">Assign</th>
                                <th class="wd-10p border-bottom-0">Status</th>
                                <th class="wd-25p border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($orders) > 0)
                                @foreach($orders as $key=>$value)
                                    <tr>
                                        <td>
                                            <a href="{{ route('cart.show',['cart'=>$value->id]) }}">{{ $value->id }}</a>
                                        </td>
                                        <td>{{ $value->user?$value->user->name:'-'  }}</td>
                                        <td>{{ $value->created_at  }}</td>
                                        <td>{{ $value->address  }}</td>
                                        <td>{{ $value->assign?$value->assign->name:'-' }}</td>
                                        <td>{{ $value->status }}</td>
                                        <td>
                                            @if($value->status === "Pending")
                                                <a data-bs-toggle="modal" data-bs-target="#largemodal_2" onclick="onSelectRequest({{ $value->id }})" class="btn btn-primary btn-pill">Assign</a>
                                            @else
                                                Already Assigned
                                            @endif
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
    <!-- End Row -->
    <!-- Assign Modal -->
    <div class="modal fade" id="largemodal_2" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Request</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="assign-captain-user" method="POST">
                        <div class="row">
                            <div class="form-group">
                                <label class="form-label">Select Captain</label>
                                <input type="hidden" name="request_id" id="request_id" />
                                <select name="captain_id" class="form-control form-select select2" data-bs-placeholder="Select Captain">
                                    @foreach($captainUsers as $captainUser)
                                        <option value="{{ $captainUser->id }}">{{ $captainUser->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button onclick="onSubmit()" class="btn btn-primary">Assign</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Assign Modal End -->
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

        function onSelectRequest(id) {
            $('#request_id').val(id)
        }

        function onSubmit() {
            const formData = $('#assign-captain-user').serializeArray();
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/admin/assign-request-to-captain', // URL of the endpoint you defined
                type: 'POST', // or 'POST', 'PUT', etc.
                data: formData,
                dataType: 'json', // Expected data type of the response
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
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
    </script>
@endpush
