@extends('layouts.captain.app')

@section('content')
    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="mt-5">
                <div class="">
                    <div class="panel panel-primary">
                        <div class="card tab-menu-heading tab-menu-heading-boxed">
                            <div class="tabs-menu tabs-menu-border">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <li><a href="#tab29" class="active" data-bs-toggle="tab">Today's Order</a></li>
                                    <li><a href="#tab30" data-bs-toggle="tab">Place Order</a></li>
                                    <li><a href="#tab31" data-bs-toggle="tab">Complete Order</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab29">
                                    <div class="row">
                                        <h1 class="page-title mb-5">Today's Order</h1>
                                        @if(count($currentOrder) > 0)
                                            @foreach($currentOrder as $value)
                                                <div class="col-xl-4 col-md-6 p-0">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $value->user->name }}</h5>
                                                            <h6 class="card-subtitle mb-5 text-muted"> Date : {{ \Carbon\Carbon::create($value->created_at)->format('Y-m-d') }}</h6>
                                                            <h6 class="card-subtitle mb-2 text-muted">Mob. No - {{ $value->mobile }}</h6>
                                                            <p class="card-text">Address : {{ $value->address }}</p>
                                                            <a href="{{ route('cart.show',['cart'=>$value->id]) }}" class="btn btn-primary">Create Cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab30">
                                    <div class="row">
                                        <h1 class="page-title mb-5">Place Order</h1>
                                        @if(count($placeOrder) > 0)
                                            @foreach($placeOrder as $value)
                                                <div class="col-xl-4 col-md-6 p-0">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $value->user->name }}</h5>
                                                            <h6 class="card-subtitle mb-5 text-muted"> Date : {{ \Carbon\Carbon::create($value->created_at)->format('Y-m-d') }}</h6>
                                                            <h6 class="card-subtitle mb-2 text-muted">Mob. No - {{ $value->mobile }}</h6>
                                                            <p class="card-text">Address : {{ $value->address }}</p>
                                                            <a href="{{ route('cart.show',['cart'=>$value->id]) }}" class="btn btn-primary">View Cart</a>
                                                            <a data-bs-toggle="modal" data-bs-target="#smallmodal" onclick="onPay({{ $value->id }})" class="btn btn-primary">Pay</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab31">
                                    <h1 class="page-title mb-5">Complete Order</h1>
                                    @if(count($completeOrder) > 0)
                                        @foreach($completeOrder as $value)
                                            <div class="col-xl-4 col-md-6 p-0">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="col-xl-12 text-end">
                                                            <a class="btn btn-success btn-pill btn-sm text-white">Complete</a>
                                                        </div>
                                                        <h5 class="card-title">{{ $value->user->name }}</h5>
                                                        <h6 class="card-subtitle mb-5 text-muted"> Date : {{ \Carbon\Carbon::create($value->created_at)->format('Y-m-d') }}</h6>
                                                        <h6 class="card-subtitle mb-2 text-muted">Mob. No - {{ $value->mobile }}</h6>
                                                        <p class="card-text">Address : {{ $value->address }}</p>

                                                        <a href="{{ route('cart.show',['cart'=>$value->id]) }}" class="btn btn-primary">View Order</a>
                                                        <button type="button" class="btn btn-rss"><i class="fa fa-rss me-2"></i>Send Invoice</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
    <div class="modal  fade" id="smallmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="p-0 pb-3">
                        <div class="card-body text-center">
                            <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="60" width="60" viewBox="0 0 24 24"><path fill="#fad383" d="M15.728,22H8.272a1.00014,1.00014,0,0,1-.707-.293l-5.272-5.272A1.00014,1.00014,0,0,1,2,15.728V8.272a1.00014,1.00014,0,0,1,.293-.707l5.272-5.272A1.00014,1.00014,0,0,1,8.272,2H15.728a1.00014,1.00014,0,0,1,.707.293l5.272,5.272A1.00014,1.00014,0,0,1,22,8.272V15.728a1.00014,1.00014,0,0,1-.293.707l-5.272,5.272A1.00014,1.00014,0,0,1,15.728,22Z"></path><circle cx="12" cy="16" r="1" fill="#f7b731"></circle><path fill="#f7b731" d="M12,13a1,1,0,0,1-1-1V8a1,1,0,0,1,2,0v4A1,1,0,0,1,12,13Z"></path></svg></span>
                            <h4 class="h4 mb-0 mt-3">Alert</h4>
                            <input type="hidden" name="selected_request_id" id="selected_request_id"/>
                            <p class="card-text">Do You Recvied Payment Form Customer.</p>
                        </div>
                        <div class="card-footer text-center border-0 pt-0">
                            <div class="row">
                                <div class="text-center">
                                    <a href="javascript:void(0)" class="btn btn-warning" onclick="onPaySubmit()">Yes</a>
                                    <a href="javascript:void(0)" class="btn btn-white me-2" data-bs-dismiss="modal">cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function onPay(id) {
            $('#selected_request_id').val(id)
        }
        function onPaySubmit() {
            const request_id = $('#selected_request_id').val()
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route("order.payment") }}', // URL of the endpoint you defined
                type: 'POST', // or 'POST', 'PUT', etc.
                data: {
                    request_id: request_id
                },
                dataType: 'json', // Expected data type of the response
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                },
                success: function (response) {
                    // Handle the response
                    toastr.success(response.message);
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
