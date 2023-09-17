@extends('layouts.app')

@section('title', 'Invoice')
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
                                <th class="wd-15p border-bottom-0">Quantity</th>
                                <th class="wd-15p border-bottom-0">Total</th>
                                <th class="wd-10p border-bottom-0">Status</th>
                                <th class="wd-25p border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($orders) > 0)
                                @foreach($orders as $key=>$value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->user?$value->user->name:'-'  }}</td>
                                        <td>{{ $value->created_at  }}</td>
                                        <td>{{ $value->address  }}</td>
                                        <td>{{ $value->quantity }}</td>
                                        <td>$ {{ $value->amount }}</td>
                                        <td>{{ $value->status }}</td>
                                        <td>
                                            <a href="{{ route('order.edit',['order'=>$value->id]) }}" class="btn btn-primary btn-pill">View</a>
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
