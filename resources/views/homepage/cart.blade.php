@extends('layouts.home')
@section('style')
    <link href="/css/cart_.css" rel="stylesheet">
@endsection
@section('content')
    <header class="title" style="max-height: 300px !important;">
        <div class="background-image-holder parallax-background">

        </div>
        <div class="container align-bottom">
            <div class="row">
                <div class="col-xs-12">

                    <h1 id="cent" class="text-white">CART</h1>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </header>
    <section class="content bg-white">
    <div class="col-sm-12 text-left">
        <a style="font-size:16px;color: #1e50a0" href="{{ back() }}" type="button" ><- Go back</a></div>

        @if ($carts->count() > 0)
            <div class="cart">
                <div class="header">
                    <div class="fw-700 fs-28 text-center" id="cart-header">My Cart</div>
                </div>
                <div class="cart-container" >
                    @include('errors.showerrors')

                    <div  class="card heading text-center color-8">
                        <div id="cart-table-header">Tests</div>
                        <div id="cart-table-header">Quantity</div>
                        <div id="cart-table-header">Amount</div>
                        <div id="cart-table-header">Action</div>
                    </div>
                    <?php $i = 0; ?>
                    <div id="underlay">
                    @foreach ($carts as $cart)
                        <br>
                        <div class="card fw-600 bg-12">
                            <div class="card-item text-left" id="cart-text">
                                <span>{{ optional($cart->vendorProduct->product)->name }}</span>

                            </div>
                            <div class="card-item">
                                {{-- <select name="" class="form-control" id="quantity_{{$i}}" >
                                    @for ($y = 1; $y < 10; $y++)
                                        <option value="{{$y}}"  @if ($cart->quantity == $y)selected @endif>{{$y}}</option>
                                    @endfor
                                </select> --}}

                                <div class="input-group">
                                     <span class="input-group-addon cart_update_btn bg-white" data-action="remove">-</span>

                                    <input type="text" style="" class="form-control text-center cart_input"
                                        id="quantity_{{ $i }}" value="{{ $cart->quantity }}"
                                        data-cart_id="{{ $cart->id }}" />

                                        <span class="input-group-addon cart_update_btn bg-white" data-action="add">+</span>
                                </div>

                            </div>
                            <div class="card-item text-center cart-p" id="cart-text">$
                                <span id="cart_item_total_{{ $cart->id }}" >
                                    {{ number_format($cart->quantity * $cart->vendorProduct->price_pounds, 2) }}</span>
                            </div>
                            <div class="card-item color-6 text-center ">
                                <a id="remove" class="btn btn-sm btn-danger"
                                    href="javascript:;" onclick="remove(' {{ $cart->id }}')"> <i
                                        class="icon icon_cross_mark"> </i> <img id="x-icon"src="https://img.icons8.com/plumpy/20/000000/cancel.png"/> Remove </a>
                                <br class="m-2">
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                    </div>
                    <div class="text-center fw-700 " id="cart-total">
                        TOTAL: <b class="color-1 price">$ <span
                                id="totalCartPrice">{{ number_format($cartSum, 2) }}</span></b>
                    </div>
                    <div class="button-container">
                        <!-- <a class="btn-3 bg-none color-1 fw-600">Back to Shopping</a> -->
                        <a id="add_button" href="{{ url('/booking') }}" type="button" style="font-size: 18px" class="btn btn-sm btn-info"
                           >Proceed to checkout</a>
                    </div>
                </div>
            </div>
        @else
            <div class="jumbotron">
                <h4 class="text-center">No products in cart</h4>
                <br>
                <center>
                    <a href="{{ url('/product/all') }}" class="btn-3 bg-1 color-1 fw-600"
                        style="color:white; padding-right:10px; padding-left:10px;">Continue
                        shopping</a>
                </center>

            </div>
        @endif
        <br>
    </section>
@endsection
@section('script')

    <script>
        $(document).ready(function() {
            $('#data_table').DataTable({
                responsive: true,
                "order": []
            });
        });

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
                success: function(data) {
                    $("#totalCartPrice").html(data.total_price);
                    btn.removeAttr("disabled");
                    $("#cart_item_total_" + id).html(data.item_total);
                },
                error: function(error) {
                    toastr.error('Error', 'Unable to process request')
                    btn.removeAttr("disabled");
                }
            });
        }

        function remove(id) {
            var d = confirm("Are you sure you want to remove this item from cart?");
            if (d) {
                window.location = "/delete/cart/" + id;
            }
        }


        $(".cart_update_btn").on("click", function() {
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

        var checkref = localStorage.getItem('ref');

        if(checkref){
            $("#add_button").attr('href',"{{ url('/booking') }}"+ "?ref=" + checkref);
        }

    </script>
@endsection
