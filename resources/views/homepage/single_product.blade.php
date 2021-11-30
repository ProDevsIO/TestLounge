@extends('layouts.home')
@section('style')
    <link href="{{ url('/css/product.css') }}" rel="stylesheet">
    <style>
        @media screen and (max-width: 508px) {
            #content {
                margin-top: 30px !important;
            }
        }

        .btn-info {
            border-color: transparent !important;
        }
    </style>
@endsection
@section('content')
    <div class="main-container">

        <header class="title" style="max-height: 300px !important;">
            <div class="background-image-holder parallax-background">

            </div>
            <div class="container align-bottom">
                <div class="row">
                    <div class="col-xs-12 h9_header">
                        <h5 id="h9" class="text-white">COUNTRY TESTS ({{optional(optional($sproducts)->product)->name}}
                            ) </h5>

                    </div>
                </div>
                <!--end of row-->
            </div>
            <!--end of container-->
        </header>
        <section class="content bg-white" style="padding:0;">
            <div class="jumbotron bg-white" style="padding: 0px">
                <div class="purchase">
                    <div class="header text-center">
                        <!-- <div class="fw-700 fs-28">Travelling from the UK</div> -->
                    </div>

                    @if (count($vproducts) > 0)
                        <div class="container">
                            <div class="container" id="show-result">

                                <div class="row">
                                    <div class="container" id="show-result">

                                    </div>

                                    <?php $i = 1 ?>
                                    <div class="row">
                                        <div class="col-md-8" id="content" style="margin-top:100px;">
                                            <h2 class="" style="text-color:black"><span
                                                    class="">{{ optional(optional($sproducts)->product)->name }}</span>
                                            </h2>
                                            <br>
                                            <p style="line-height:50px; font-size: 16px;">{!! optional(optional($sproducts)->product)->description !!}</p>
                                        </div>


                                        @foreach ($vproducts as $vproduct)




                                            <div class="col-md-4">
                                                <div class="col-md-12 card"
                                                     style="margin-top:20px;padding:50px; border-radius:10px; background-color:#24477f;">

                                                    <div class="container text-center"
                                                         style="padding-left:0; padding-right:0;">
                                                        {{-- <a onclick ="addCart('{{$vproduct->product->id}}', '{{$vproduct->vendor->id}}')" --}}

                                                        @if ($vproduct->cartItem)
                                                            <div
                                                                class="input-group count_now{{ $vproduct->product->id }}">
                                                                                                                <span
                                                                                                                    class="input-group-addon cart_update_btn bg-white"
                                                                                                                    data-action="remove">-</span>

                                                                <input type="text"
                                                                       style=""
                                                                       class="form-control text-center cart_input"
                                                                       id="quantity_{{ $i }}"
                                                                       value="{{ $vproduct->cartItem->quantity }}"
                                                                       data-cart_id="{{  $vproduct->cartItem->id }}"/>

                                                                <span class="input-group-addon cart_update_btn bg-white"
                                                                      data-action="add">+</span>
                                                            </div>
                                                            <br>
                                                            <h5 class="text-center"
                                                                style="color:white !important;"><span
                                                                    class=""> £{{ number_format(optional($vproduct)->price / 830)}} / ${{ optional($vproduct)->price_pounds }} </span>
                                                            </h5>
                                                            <a id="remove_button"
                                                               type="button"
                                                               data-button="remove_button"
                                                               data-product_id="{{ $vproduct->product->id }}"
                                                               data-vendor_id="{{ $vproduct->vendor->id }}"
                                                               class="btn btn-outline-info cart_btn"
                                                               style="border:1px solid #1E50A0;">
                                                                Remove

                                                            </a>

                                                        @else

                                                            <div
                                                                class="input-group count_now{{ $vproduct->product->id }}"
                                                                style="display: none;">
                                                                                                                <span
                                                                                                                    class="input-group-addon cart_update_btn bg-white"
                                                                                                                    data-action="remove">-</span>

                                                                <input type="text"
                                                                       style=""
                                                                       class="form-control text-center cart_input cart{{ $vproduct->product->id  }}"
                                                                       id="quantity_{{ $i }}"
                                                                       value="1"
                                                                       data-cart_id=""/>

                                                                <span class="input-group-addon cart_update_btn bg-white"
                                                                      data-action="add">+</span>
                                                            </div>

                                                            <h5 class="text-center"
                                                                style="color:white !important;"><span
                                                                    class="">£{{ number_format(optional($vproduct)->price / 830)}} / ${{ optional($vproduct)->price_pounds }}</span>
                                                            </h5>
                                                            <a id="add_button"
                                                               type="button"
                                                               data-button="add_button"
                                                               style="align:center;"
                                                               data-product_id="{{ $vproduct->product->id }}"
                                                               data-vendor_id="{{ $vproduct->vendor->id }}"
                                                               class="btn btn-info cart_btn "
                                                            >
                                                                Add to
                                                                cart
                                                            </a>

                                                    @endif
                                                    <!-- <a href="/view/cart" id="add_button" class="btn btn-info">Go to cart</a> -->

                                                    </div>
                                                </div>
                                                <div class="col-sm-12 text-center" style="margin-top:50px"><a
                                                        id="go_button"
                                                        href="{{ url('/view/cart') }}"
                                                        type="button" class="btn bg-1">Go
                                                        to cart <img
                                                            src="https://img.icons8.com/fluency/20/000000/right.png"/></a>
                                                </div>
                                            </div>


                                            <?php $i++; ?>
                                        @endforeach
                                        <div> &nbsp;</div>
                                    </div>

                                    @else
                                        <div style="padding: 50px 50px 30px 50px">
                                            <h4 class="text-center">No product available
                                                for now</h4>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
        </section>

        <br>

    </div>
@endsection
@section('script')
    <script>

        $(".cart_btn").on("click", function (e) {
            e.preventDefault();
            const btn = $(this);
            btn.attr("disabled", true);
            const product_id = btn.attr("data-product_id");
            const vendor_id = btn.attr("data-vendor_id");
            const button = btn.attr("data-button");

            if (product_id && vendor_id) {
                var url = '/add/cart/' + product_id + '/' + vendor_id;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "get",
                    url: url,
                    data: null,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        if (data.error == "yes") {
                            toastr.warning(data.message);
                            btn.attr("disabled", false);
                            $(".count_now" + product_id).hide();
                        } else {
                            toastr.success(data.message)
                            btn.html(data.btn_text)
                            btn.css({
                                "backgroundColor": data.btn_color,
                                "color": data.color
                            });
                            btn.removeAttr("disabled");
                            $(".cart_count_item").html(data.cart_items);
                            console.log(button);
                            if (button == "add_button") {
                                $(".cart" + product_id).attr('data-cart_id', data.cart_id);
                                btn.attr("data-button", "remove_button");
                                console.log(".count_now" + product_id);
                                $(".count_now" + product_id).show();
                            } else {
                                btn.attr("data-button", "add_button");

                                $(".count_now" + product_id).hide();
                            }
                        }
                    },
                    error: function (error) {
                        toastr.error('Error', 'Unable to process request')
                        console.log(error);
                        btn.removeAttr("disabled");
                    }
                });
            }
        })

        function addCart(product_id, vendor_id) {

            var url = '/add/cart/' + product_id + '/' + vendor_id;
            $("#show-result")
                .find('p')
                .remove()
                .end();
            $.get(url, function (data) {

                var holder = document.getElementById("show-result");
                var newNode = document.createElement('p');
                var close = document.createElement('a');
                newNode.innerHTML = data;
                close.innerHTML = "X";
                holder.appendChild(newNode);
                newNode.appendChild(close);
                $("#show-result p a").addClass('close')
                $("#show-result p a").attr("data-dismiss", "alert")
                $("#show-result p").addClass('alert alert-info')
            });
        }

        function countryQuery() {

            var country_id = document.getElementById("country").value;
            console.log(country_id);
            var url = '/country/query/' + country_id;
            $("#show-result")
                .find('p')
                .remove()
                .end();
            $.get(url, function (data) {

                var holder = document.getElementById("show-result");
                var newNode = document.createElement('p');
                var close = document.createElement('a');
                newNode.innerHTML = data;
                close.innerHTML = "X";
                holder.appendChild(newNode);
                newNode.appendChild(close);
                $("#show-result p a").addClass('close')
                $("#show-result p a").attr("data-dismiss", "alert")
                $("#show-result p").addClass('alert')
                $("#show-result p").addClass('p-2')
                $("#show-result p").attr("style", "background-color: #1E50A0;color:white;margin-bottom: 5px;")

            });
        }

        $(".cart_update_btn").on("click", function () {
            const btn = $(this);
            const input = btn.parent().find("input");
            if (input !== undefined) {
                let inputValue = $(input[0])
                const value_ = parseInt(inputValue.val());
                let value = value_
                const action = btn.attr("data-action")
                if (action == "add") {
                    value = value + 1
                } else {
                    if (value >= 2) {
                        value = value - 1
                    }
                }
                if (value_ != value) {
                    inputValue.val(value)
                    update(btn, input.attr("data-cart_id"), value);

                }
            }
        })

        function update(btn, id, quantity) {
            btn.attr("disabled", true);
            const url = "/update/cart/" + id + "/" + quantity;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: url,
                data: null,
                dataType: 'json',
                success: function (data) {
                    toastr.success('Successfully updated quantity in cart')
                    $("#totalCartPrice").html(data.total_price);
                    btn.removeAttr("disabled");
                    $("#cart_item_total_" + id).html(data.item_total);
                },
                error: function (error) {
                    toastr.error('Error', 'Unable to process request')
                    btn.removeAttr("disabled");
                }
            });
        }
    </script>
@endsection
