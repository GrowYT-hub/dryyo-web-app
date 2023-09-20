@extends('layouts.captain.app')

@section('content')
    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="mt-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Cart</h3>
                        <div class="accordion" id="accordionExample">

                            @foreach($carts as $key=>$value)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne{{ $key }}" aria-expanded="true"
                                                aria-controls="collapseOne">
                                            {{ $value->name }}
                                        </button>
                                    </h2>
                                    <div id="collapseOne{{ $key }}" class="accordion-collapse collapse show"
                                         aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="custom-controls-stacked">
                                                @foreach($value->categories as $categories)
                                                    <h5 class="card-title">{{ $categories->name }}</h5>
                                                    @foreach($categories->subCategories as $subCategories)
                                                        <form id="view-cart-{{ $subCategories->id }}" method="POST">
                                                            @php
                                                                $collection = new \Illuminate\Database\Eloquent\Collection($orders);
                                                                $exists = $collection->where('sub_categories_id', $subCategories->id)->first();
                                                            @endphp
                                                            <div class="d-flex mb-2">
                                                                <div class="w-50">
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="hidden" name="type_name" value="{{ $value->name }}">
                                                                        <input type="hidden" name="type_id" value="{{ $value->id }}">
                                                                        <input type="hidden" name="categories_id" value="{{ $categories->id }}">
                                                                        <input type="hidden" name="categories_name" value="{{ $categories->name }}">
                                                                        <input type="hidden" name="subCategories" value="{{ $subCategories }}">
                                                                        @if($exists)
                                                                            <input type="checkbox"
                                                                                   class="custom-control-input"
                                                                                   name="example-checkbox2" value="option2" checked>
                                                                        @else
                                                                            <input type="checkbox"
                                                                                   class="custom-control-input"
                                                                                   name="example-checkbox2" value="option2">
                                                                        @endif

                                                                        <span
                                                                            class="custom-control-label">{{ $subCategories->name }}</span>
                                                                    </label>
                                                                </div>
                                                                <div class="w-50">
                                                                    <div class="input-group input-indec input-indec1">
                                                                            <span class="input-group-btn">
                                                                                @if($services->status === "Completed" || !in_array('captain',array_column(Auth::guard()->user()->roles->toArray(),'name')))
                                                                                    <button type="button"
                                                                                            class="minus btn btn-white btn-number btn-icon br-7" disabled >
                                                                                    <i class="fa fa-minus text-muted"></i>
                                                                                </button>
                                                                                @else
                                                                                    <button type="button"
                                                                                            class="minus btn btn-white btn-number btn-icon br-7" onclick="onIncreaseDescrease({{ $subCategories->id }},'Decrease')" >
                                                                                    <i class="fa fa-minus text-muted"></i>
                                                                                </button>
                                                                                @endif

                                                                            </span>
                                                                        @if($exists)
                                                                            <input type="text" name="quantity"
                                                                                   class="form-control text-center qty"
                                                                                   value="{{ $exists->quantity }}">
                                                                        @else
                                                                            <input type="text" name="quantity"
                                                                                   class="form-control text-center qty"
                                                                                   value="0">
                                                                        @endif

                                                                        <span class="input-group-btn">
                                                                            @if($services->status === "Completed" || !in_array('captain',array_column(Auth::guard()->user()->roles->toArray(),'name')))
                                                                                <button type="button"
                                                                                        class="quantity-right-plus btn btn-white btn-number btn-icon br-7 add" disabled>
                                                                                    <i class="fa fa-plus text-muted"></i>
                                                                                </button>
                                                                            @else
                                                                                <button type="button"
                                                                                        class="quantity-right-plus btn btn-white btn-number btn-icon br-7 add" onclick="onIncreaseDescrease({{ $subCategories->id }},'Increase')">
                                                                                    <i class="fa fa-plus text-muted"></i>
                                                                                </button>
                                                                            @endif

                                                                            </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-12 text-center mb-5">
                        <a data-bs-toggle="modal" data-bs-target="#largemodal" class="btn btn-primary"
                           onclick="viewCart()">View Order</a>
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
                    <h5 class="modal-title">Cart list</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="" data-bs-popper="static">
                        <div class="header-dropdown-list message-menu ps">
                            <div id="cart-list">

                            </div>
                            <hr>

                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                            </div>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <div class="dropdown-footer">
                            <a class="btn btn-primary btn-pill w-sm btn-sm py-2"><i class="fe fe-check-circle"></i>
                                Checkout</a>
                            <span class="float-end p-2 fs-17 fw-semibold" id="final-total">Total: 0</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#order-submit">
                        @if(in_array('captain',array_column(Auth::guard()->user()->roles->toArray(),'name')))
                            <button class="btn btn-primary" onclick="onOrderplace()">Order Place</button>
                        @else
                            <button class="btn btn-primary" disabled onclick="onOrderplace()">Order Place</button>
                        @endif

                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal  fade" id="largemodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function viewCart() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/captain/cart/{{ $request_id }}/edit',
                type: 'GET',
                dataType: 'json', // Expected data type of the response
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                },
                success: function (response) {
                    // Handle the response
                    var html = '<form id="view-cart-form">';
                    response.data.map((value, key)=>{

                        var washing_price_checkbox = '';
                        if (value?.orders?.washing_price > 0){
                            washing_price_checkbox += `
                            <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           name="washing_price" checked="checked" value="${value.washing_price}">
                                                    <span class="custom-control-label">Washing (${value.washing_price})</span>
                                                </label>
                            `
                        }else {
                            washing_price_checkbox += `
                            <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           name="washing_price" value="${value.washing_price}">
                                                    <span class="custom-control-label">Washing (${value.washing_price})</span>
                                                </label>
                            `
                        }

                        var iron_price_checkbox = '';
                        if (value?.orders?.iron_price > 0){
                            iron_price_checkbox += `
                            <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           name="iron_price" checked="checked" value="${value.iron_price}">
                                                    <span class="custom-control-label">Iron (${value.iron_price})</span>
                                                </label>
                            `
                        }else {
                            iron_price_checkbox += `
                            <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           name="iron_price" value="${value.iron_price}">
                                                    <span class="custom-control-label">Iron (${value.iron_price})</span>
                                                </label>
                            `
                        }

                        var dry_clean_price_checkbox = '';
                        if (value?.orders?.dry_cleaning_price > 0){
                            dry_clean_price_checkbox += `
                            <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           name="dry_cleaning_price" checked="checked" value="${value.dry_cleaning_price}">
                                                    <span class="custom-control-label">Dry cleaning (${value.dry_cleaning_price})</span>
                                                </label>
                            `
                        }else {
                            dry_clean_price_checkbox += `
                            <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           name="dry_cleaning_price" value="${value.dry_cleaning_price}">
                                                    <span class="custom-control-label">Dry cleaning (${value.dry_cleaning_price})</span>
                                                </label>
                            `
                        }
                        html += `<div class="dropdown-item d-flex p-4">
                                    <div class="wd-50p">
                                            <h5 class="mb-5 card-title">${value.sub_categories.name} (${value.types.name})</h5>
                                            <div class="d-flex">
                                                <div class="w-50 mb-2">
                                                    <input type="hidden" name="cart_id" value="${value.id}">
                                                    <div class="input-group input-indec input-indec1">
                                                    <span class="input-group-btn">
                                                        <button type="button"
                                                                class="minus btn btn-white btn-number btn-icon br-7 minus ">
                                                            <i class="fa fa-minus text-muted"></i>
                                                        </button>
                                                    </span>
                                                        <input type="text" name="quantity" class="form-control text-center qty"
                                                               value="${value.quantity}">
                                                        <span class="input-group-btn">
                                                        <button type="button"
                                                                class="quantity-right-plus btn btn-white btn-number btn-icon br-7 add">
                                                            <i class="fa fa-plus text-muted"></i>
                                                        </button>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex mt-5">
                                                <div class="w-40">
                                                    ${washing_price_checkbox}
                                                </div>
                                                <div class="w-30">
                                                    ${iron_price_checkbox}
                                                </div>
                                                <div class="w-30">
                                                    ${dry_clean_price_checkbox}
                                                </div>
                                            </div>
                                        </div>
                                    <div class="ms-auto text-end d-flex fs-16">
                                    <span id="total-amount-${key}" class="fs-16 text-dark d-none d-sm-block px-4">
                                        0
                                    </span>
                                        <button  type="button" onclick="onDeleteCart(${value.id})" class="fs-16 btn p-0 cart-trash">
                                            <i class="fe fe-trash-2 border text-danger brround d-block p-2"></i>
                                        </button>
                                    </div>
                                </div>`
                    })
                    html += `</form>`
                    $('#cart-list').html(html)
                    toastr.success(response.message);
                    calculateTotalAmount();
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

        function onIncreaseDescrease(id, type = 'Increase') {
            setTimeout(()=>{
                let form_id = '#view-cart-'+id
                const formData = $(form_id).serializeArray();
                const newParam = {
                    name: 'request_id',
                    value: '{{ $request_id }}' // Replace with the desired value
                };
                formData.push(newParam)
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route("cart.store") }}', // URL of the endpoint you defined
                    type: 'POST', // or 'POST', 'PUT', etc.
                    data: formData,
                    dataType: 'json', // Expected data type of the response
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                    },
                    success: function (response) {
                        // Handle the response
                        toastr.success(response.message);
                        viewCart()
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
            },1000)
        }

        $(document).on('change', 'input[type="checkbox"]', function() {
            calculateTotalAmount();
        });

        function calculateTotalAmount() {
            // Loop through all the cart items and calculate the total based on checked checkboxes.
            var i = 0;
            let finalTotalAmount = 0;
            $('#cart-list').find('.dropdown-item').each(function() {
                let totalAmount = 0;
                const isWashingChecked = $(this).find('[name="washing_price"]').prop("checked");
                const isIronChecked = $(this).find('[name="iron_price"]').prop("checked");
                const isDryCleaningChecked = $(this).find('[name="dry_cleaning_price"]').prop("checked");
                const quantity = parseFloat($(this).find('.qty').val()) || 0;
                if (isWashingChecked || isIronChecked || isDryCleaningChecked) {
                    const washingPrice = parseFloat($(this).find('[name="washing_price"]').val()) || 0;
                    const ironPrice = parseFloat($(this).find('[name="iron_price"]').val()) || 0;
                    const dryCleaningPrice = parseFloat($(this).find('[name="dry_cleaning_price"]').val()) || 0;

                    const itemTotal = ((isWashingChecked ? washingPrice : 0) + (isIronChecked ? ironPrice : 0) + (isDryCleaningChecked ? dryCleaningPrice : 0)) * quantity;
                    totalAmount += itemTotal;
                }
                finalTotalAmount += totalAmount
                // Update the total amount label with the calculated value.
                $('#total-amount-'+i).text('₹' + totalAmount.toFixed(2));
                i++;
            });
            console.log(finalTotalAmount, "finalTotalAmount")
            $('#final-total').text('Total: ₹'+finalTotalAmount.toFixed(2))

        }

        function onOrderplace() {
            const formData = $('#view-cart-form').serializeArray();
            console.log(formData)
            const structuredResponse = convertToStructuredResponse(formData);
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route("order.store") }}',
                type: 'POST',
                dataType: 'json', // Expected data type of the response
                data: {
                    data: structuredResponse,
                    request_id: '{{ $request_id }}'
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                },
                success: function (response) {
                    // Handle the response
                    toastr.success(response.message);
                    setTimeout(()=>{
                        window.location.href = '/captain/dashboard'
                    },100)
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

        function convertToStructuredResponse(inputData) {
            const structuredResponse = [];
            let currentCartItem = {};

            inputData.forEach(item => {
                if (item.name === "cart_id") {
                    if (currentCartItem.hasOwnProperty("cart_id")) {
                        structuredResponse.push(currentCartItem);
                    }
                    currentCartItem = { "cart_id": item.value };
                } else {
                    currentCartItem[item.name] = item.value;
                }
            });

            // Push the last cart item to the structured response
            if (currentCartItem.hasOwnProperty("cart_id")) {
                structuredResponse.push(currentCartItem);
            }

            return structuredResponse;
        }

        function onDeleteCart(cart_id) {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/captain/cart/'+cart_id, // URL of the endpoint you defined
                type: 'DELETE', // or 'POST', 'PUT', etc.
                dataType: 'json', // Expected data type of the response
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                },
                success: function (response) {
                    // Handle the response
                    toastr.success(response.message);
                    viewCart()
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
