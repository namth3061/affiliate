@extends('backend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid">
            <form class="" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row gutters-10">
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-header d-block">
                                <div class="form-group">
                                    <input class="form-control form-control-sm" type="text" name="keyword"
                                           placeholder="Search by Product Name/Barcode" onkeyup="filterProducts()">
                                </div>
                                <div class="row gutters-5">
                                    <div class="col-md-6">
                                        <select name="poscategory" class="form-control form-control-sm aiz-selectpicker"
                                                data-live-search="true" onchange="filterProducts()">
                                            <option value="">All Categories</option>
                                            @foreach (\App\Category::all() as $key => $category)
                                                <option
                                                    value="category-{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="brand" class="form-control form-control-sm aiz-selectpicker"
                                                data-live-search="true" onchange="filterProducts()">
                                            <option value="">All Brands</option>
                                            @foreach (\App\Brand::all() as $key => $brand)
                                                <option
                                                    value="{{ $brand->id }}">{{ $brand->getTranslation('name') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="aiz-pos-product-list c-scrollbar-light">
                                    <div class="row gutters-5" id="product-list">

                                    </div>
                                    <div id="load-more">
                                        <p class="text-center fs-14 fw-600 p-2 bg-soft-primary c-pointer"
                                           onclick="loadMoreProduct()">Load More</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <select name="user_id"
                                                class="form-control form-control-sm aiz-selectpicker pos-customer" id="pos-customer-select-delivery"
                                                data-live-search="true" onchange="getShippingAddress()">
                                            <option value="">{{translate('Walk In Customer')}}</option>
                                            @foreach (\App\Customer::all() as $key => $customer)
                                                @if ($customer->user)
                                                    <option value="{{ $customer->user->id }}"
                                                            data-contact="{{ $customer->user->email }}"
                                                            data-address="{{ $customer->user->address }}"
                                                            data-phone="{{ $customer->user->phone }}">{{ $customer->user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-icon btn-soft-dark ml-3" data-toggle="modal"
                                            title="Chọn cộng tác viên">
                                        <i class="las la-users"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card mar-btm" id="cart-details">
                            <div class="card-body">
                                <div class="aiz-pos-cart-list c-scrollbar-light">
                                    <table class="table aiz-table mb-0 mar-no" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="50%">{{translate('Product')}}</th>
                                            <th width="15%">{{translate('QTY')}}</th>
                                            <th>{{translate('Price')}}</th>
                                            <th>{{translate('Subtotal')}}</th>
                                            <th class="text-right">{{translate('Remove')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $subtotal = 0;
                                            $tax = 0;
                                            $shipping = 0;
                                        @endphp
                                        @if (Session::has('posCart'))
                                            @forelse (Session::get('posCart') as $key => $cartItem)
                                                @php
                                                    $subtotal += $cartItem['price']*$cartItem['quantity'];
                                                    $tax += $cartItem['tax']*$cartItem['quantity'];
                                                    $shipping += $cartItem['shipping']*$cartItem['quantity'];
                                                    if(Session::get('shipping', 0) == 0){
                                                        $shipping = 0;
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <span class="media">
                                                            <div class="media-left">
                                                                <img class="mr-3" height="60"
                                                                     src="{{ uploaded_asset(\App\Product::find($cartItem['id'])->thumbnail_img) }}">
                                                            </div>
                                                            <div class="media-body">
                                                                {{ \App\Product::find($cartItem['id'])->name }} ({{ $cartItem['variant'] }})
                                                            </div>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="">
                                                            <input type="number" class="form-control px-0 text-center"
                                                                   placeholder="1" id="qty-{{ $key }}"
                                                                   value="{{ $cartItem['quantity'] }}"
                                                                   onchange="updateQuantity({{ $key }})" min="1">
                                                        </div>
                                                    </td>
                                                    <td>{{ single_price($cartItem['price']) }}</td>
                                                    <td>{{ single_price($cartItem['price']*$cartItem['quantity']) }}</td>
                                                    <td class="text-right">
                                                        <button type="button"
                                                                class="btn btn-circle btn-icon btn-sm btn-danger"
                                                                onclick="removeFromCart({{ $key }})">
                                                            <i class="las la-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">
                                                        <i class="las la-frown la-3x opacity-50"></i>
                                                        <p>{{translate('No Product Added') }}</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer bord-top">
                                <table class="table mb-0 mar-no" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="text-center">{{translate('Sub Total')}}</th>
                                        <th class="text-center">{{translate('Total Tax')}}</th>
                                        <th class="text-center">{{translate('Total Shipping')}}</th>
                                        <th class="text-center">{{translate('Discount')}}</th>
                                        <th class="text-center">{{translate('Total')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center">{{ single_price($subtotal) }}</td>
                                        <td class="text-center">{{ single_price($tax) }}</td>
                                        <td class="text-center">{{ single_price($shipping) }}</td>
                                        <td class="text-center">{{ single_price(Session::get('pos_discount', 0)) }}</td>
                                        <td class="text-center">{{ single_price($subtotal+$tax+$shipping - Session::get('pos_discount', 0)) }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="pos-footer mar-btm">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <div class="dropdown mr-3 dropup">
                                        <button id="add-info-delivery-btn" type="button" class="btn btn-outline-dark btn-styled "
                                                data-target="#new-customer" data-toggle="modal">
                                            Thông tin giao hàng
                                        </button>
                                    </div>
                                    <div class="dropdown dropup">
                                        <button class="btn btn-outline-dark btn-styled dropdown-toggle" type="button"
                                                data-toggle="dropdown">
                                            {{translate('Discount')}}
                                        </button>
                                        <div class="dropdown-menu p-3 dropdown-menu-lg">
                                            <div class="input-group">
                                                <input type="number" min="0" placeholder="Amount" name="discount"
                                                       class="form-control"
                                                       value="{{ Session::get('pos_discount', 0) }}" required
                                                       onchange="setDiscount()">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">{{translate('Flat') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" class="btn btn-primary" data-target="#order-confirm" id="pay-with-cash"
                                            data-toggle="modal">{{translate('Pay With Cash') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('modal')
    @include('pos.modal_pos')
@endsection


@section('script')
    @include('pos.delivery_partner_js')
    <script type="text/javascript">

        var products = null;
        var deliveryPartnerType = 2;

        $(document).ready(function () {
            $('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
            $('#product-list').on('click', '.product-card', function () {
                var id = $(this).data('id');
                $.get('{{ route('variants') }}', {id: id}, function (data) {
                    if (data == 0) {
                        addToCart(id, null, 1);
                    } else {
                        $('#variants').html(data);
                        $('#product-variation').modal('show');
                    }
                });
            });
            filterProducts();
            getShippingAddress();
        });

        function filterProducts() {
            var keyword = $('input[name=keyword]').val();
            var category = $('select[name=poscategory]').val();
            var brand = $('select[name=brand]').val();
            $.get('{{ route('pos.search_product') }}', {
                keyword: keyword,
                category: category,
                brand: brand
            }, function (data) {
                products = data;
                $('#product-list').html(null);
                setProductList(data);
            });
        }

        function loadMoreProduct() {
            if (products != null && products.links.next != null) {
                $.get(products.links.next, {}, function (data) {
                    products = data;
                    setProductList(data);
                });
            }
        }

        function setProductList(data) {
            for (var i = 0; i < data.data.length; i++) {
                $('#product-list').append('<div class="col-3">' +
                    '<div class="card bg-light c-pointer mb-2 product-card" data-id="' + data.data[i].id + '" >' +
                    '<span class="absolute-top-left bg-dark text-white px-1">' + data.data[i].price + '</span>' +
                    '<img src="' + data.data[i].thumbnail_image + '" class="card-img-top img-fit h-100px mw-100 mx-auto" >' +
                    '<div class="card-body p-2">' +
                    '<div class="text-truncate-2 small">' + data.data[i].name + '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
            }
            if (data.links.next != null) {
                $('#load-more').find('.text-center').html('Load More');
            } else {
                $('#load-more').find('.text-center').html('Nothing more found');
            }
            $('[data-toggle="tooltip"]').tooltip();
        }

        function removeFromCart(key) {
            $.post('{{ route('pos.removeFromCart') }}', {_token: '{{ csrf_token() }}', key: key}, function (data) {
                $('#cart-details').html(data);
                $('#product-variation').modal('hide');
            });
        }

        function addToCart(product_id, variant, quantity) {
            if (!variant){
                AIZ.plugins.notify('danger', 'Vui lòng chọn sản phẩm');
                return false
            }

            $.post('{{ route('pos.addToCart') }}', {
                _token: '{{ csrf_token() }}',
                product_id: product_id,
                variant: variant,
                quantity,
                quantity
            }, function (data) {
                $('#cart-details').html(data);
                $('#product-variation').modal('hide');
            });
        }

        function addVariantProductToCart(id) {
            var variant = $('input[name=variant]:checked').val();
            addToCart(id, variant, 1);
        }

        function updateQuantity(key) {
            $.post('{{ route('pos.updateQuantity') }}', {
                _token: '{{ csrf_token() }}',
                key: key,
                quantity: $('#qty-' + key).val()
            }, function (data) {
                $('#cart-details').html(data);
                $('#product-variation').modal('hide');
            });
        }

        function setDiscount() {
            var discount = $('input[name=discount]').val();
            $.post('{{ route('pos.setDiscount') }}', {
                _token: '{{ csrf_token() }}',
                discount: discount
            }, function (data) {
                $('#cart-details').html(data);
                $('#product-variation').modal('hide');
            });
        }

        function setShipping() {
            var shipping = $('input[name=shipping]:checked').val();
            $.post('{{ route('pos.setShipping') }}', {
                _token: '{{ csrf_token() }}',
                shipping: shipping
            }, function (data) {
                $('#cart-details').html(data);
                $('#product-variation').modal('hide');
            });
        }

        function getShippingAddress() {

            $.post('{{ route('pos.getShippingAddress') }}', {
                _token: '{{ csrf_token() }}',
                id: $('select[name=user_id]').val()
            }, function (data) {
                $('#shipping_address').html(data);
            });
        }

        function add_new_address() {
            var customer_id = $('#customer_id').val();
            $('#set_customer_id').val(customer_id);
            $('#new-address-modal').modal('show');
            $("#close-button").click();
        }

        function submitOrder(payment_type) {

            if ($('#choiceDeliveryTypeSelect').val() == deliveryPartnerType){
                var data = $('#form-submit-order-when-use-delivery-partner').serializeArray(); // convert form to array
                let user_id = $('select[name=user_id]').val(),
                    discount = $('input[name=discount]').val();
                data.push({name: '_token', value: '{{ csrf_token() }}'});
                data.push({name: 'fee', value: $('#shipping_fee_delivery_partner').text()});
                data.push({name: 'user_id', value: user_id});
                data.push({name: 'discount', value: discount});
                data.push({name: 'payment_type', value: payment_type});
                data.push({name: 'delivery_partner_id', value: $('#choiceDeliveryPartnerSelect option:selected').attr('delivery_partner')});
                data.push({name: 'delivery_tenancy_id', value: $('#choiceDeliveryPartnerSelect option:selected').val()});
                data.push({name: 'delivery_type', value: $('#choiceDeliveryTypeSelect option:selected').val()});
                data.push({name: 'district', value: $('#to_district_id option:selected').text()});
                data.push({name: 'ward', value: $('#to_ward_code option:selected').text()});
                data.push({name: 'province', value: ''});
                return submitOrderByDelivery(data);
            }

            var user_id = $('select[name=user_id]').val();
            var name = $('input[name=name]').val();
            var email = $('input[name=email]').val();
            var address = $('textarea[name=address]').val();
            var country = $('select[name=country]').val();
            var city = $('input[name=city]').val();
            var postal_code = $('input[name=postal_code]').val();
            var phone = $('input[name=phone]').val();
            var shipping = $('input[name=shipping]:checked').val();
            var discount = $('input[name=discount]').val();
            var address = $('input[name=address_id]:checked').val();

            $.post('{{ route('pos.order_place') }}', {
                _token: '{{ csrf_token() }}',
                user_id: user_id,
                name: name,
                email: email,
                address: address,
                country: country,
                city: city,
                postal_code: postal_code,
                phone: phone,
                shipping_address: address,
                payment_type: payment_type,
                shipping: shipping,
                discount: discount
            }, function (data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{translate('Order Completed Successfully.') }}');
                    location.reload();
                } else {
                    AIZ.plugins.notify('danger', '{{translate('Something went wrong') }}');
                }
            });
        }

        function submitOrderByDelivery(data) {
            $.post('{{ route('pos.order_delivery_place') }}', data, function (data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{translate('Order Completed Successfully.') }}');
                    location.reload();
                } else {
                    AIZ.plugins.notify('danger', data.msg ? data.msg : '{{translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
