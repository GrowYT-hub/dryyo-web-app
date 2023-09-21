@extends('layouts.app')

@section('title', 'Invoice')
@section('content')
    <!-- ROW-1 OPEN -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <a class="header-brand" href="index.html">
                                <img src="{{ asset('assets/images/brand/logo-dark.png') }}" class="header-brand-img logo-3" alt="Sash logo">
                                <img src="{{ asset('assets/images/brand/logo-white.png') }}" class="header-brand-img logo" alt="Sash logo">
                            </a>
                            <div>
{{--                                <address class="pt-3">--}}
{{--                                    {{ $invoice->address }}<br>--}}
{{--                                    {{ $invoice->user->email }}--}}
{{--                                </address>--}}
                            </div>
                        </div>
                        <div class="col-lg-6 text-end border-bottom border-lg-0">
                            <h3>#{{ $invoice->id }}</h3>
                            <h5>Date Issued: {{ \Carbon\Carbon::create($invoice->updated_at)->format('Y-m-d') }}</h5>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-lg-6">
                            <p class="h3">Invoice To:</p>
                            <p class="fs-18 fw-semibold mb-0">{{ $invoice->user->name }}</p>
                            <address>
                                {{ $invoice->address }}
                                {{ $invoice->user->email }}
                            </address>
                        </div>
                        <div class="col-lg-6 text-end">
{{--                            <p class="h4 fw-semibold">Payment Details:</p>--}}
{{--                            <p class="mb-1">Total Due: {{ $invoice->amount }}</p>--}}
{{--                            <p class="mb-1">Bank Name: Union Bank 0456</p>--}}
{{--                            <p class="mb-1">IBAN: 543218769</p>--}}
{{--                            <p>Country: USA</p>--}}
                        </div>
                    </div>
                    <div class="table-responsive push">
                        <table class="table table-bordered table-hover mb-0 text-nowrap">
                            <tbody>
                            <tr class=" ">
                                <th class="text-center"></th>
                                <th>Item</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-end">Sub Total</th>
                            </tr>
                            @if(count($carts)> 0)
                                @foreach($carts as $key=>$value)
                                    @php
                                        $total = 0;
                                        $quantity = 0;
                                        if ($value->orders){
                                            $total = (integer)$value->orders->washing_price + (integer)$value->orders->iron_price + (integer)$value->orders->dry_cleaning_price;
                                        }
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>
                                            <p class="font-w600 mb-1">{{ $value->types->name }}</p>
                                            <div class="text-muted">
                                                <div class="text-muted">{{ $value->categories->name }} - {{ $value->subCategories->name }}</div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $value->quantity }}</td>
                                        <td class="text-end">₹ {{ $total }}</td>
                                        <td class="text-end">₹ {{ $total * (integer)$value->quantity }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            <tr>
                                <td colspan="4" class="fw-bold text-uppercase text-end">Total</td>
                                <td class="fw-bold text-end h4">₹ {{ $invoice->amount }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-secondary mb-1" onclick="javascript:window.print();"><i class="si si-paper-plane"></i> Send Invoice</button>
                    <button type="button" class="btn btn-danger mb-1" onclick="javascript:window.print();"><i class="si si-printer"></i> Print Invoice</button>
                </div>
            </div>
        </div>
        <!-- COL-END -->
    </div>
    <!-- ROW-1 CLOSED -->
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
