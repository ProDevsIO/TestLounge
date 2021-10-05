@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
         .cart_update_btn{
             padding:.400rem .80rem;
            background-color: #e5e8eb;
        
        }
         .cart_update_btn:hover {
            background-color: white;
        }
        /* .dataTables_length{
            display:flex;
        }
        .dataTables_filter{
            float:right;
            margin:0;
            padding:0;
        } */
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="container m-2"><h3>Purchase Product Vouchers here</h3></div>
            @include('errors.showerrors')
                <?php $i =1 ?>
                @foreach($vproducts as $product)
                    <div class="col-sm-3 m-2">
                        <div class="card">
                            <!-- <img class="card-img-top" src="/img/hero11.jpg" alt="Card image"> -->
                            <div class="card-body text-center">
                                <h4 class="card-title">{{ optional($product->product)->name }}</h4>
                                <p class="card-text cart_item_total_{{ $product->id }}">
                                   
                                    $ {{ number_format($product->price_pounds) }}
                                
                                </p>
                                <div class="input-group">
                                    <span class="input-group-addon cart_update_btn mb-3" data-action="remove">-</span>
                                    <input type="text" class="bg-white form-control text-center cart_input"
                                        id="quantity_{{ $i }}" value="1"
                                        data-cart_id="{{ $product->id }}" readonly />
                                    <span class="input-group-addon cart_update_btn mb-3" data-action="add">+</span>
                                 
                                </div>

                                <a href="javascript:;" onclick="run('{{$product->product_id}}','{{$product->vendor_id}}' ,'{{$i}}')" class="btn bg-purple text-white btn-block">Buy</a>
                            </div>
                        </div>
                    </div>
                    <?php $i++ ?>
                @endforeach
            </div>
        </div>
    </div>

@endsection
@section('script')
<script>
      $(".cart_update_btn").on("click", function() {
            const btn = $(this);
            const div = $(this);
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
                    const url = "/process/price/" + input.attr("data-cart_id") + "/" + value;
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
                            var total = $(".cart_item_total_" + input.attr("data-cart_id"));
                            total.empty();
                            total.append(data.item_total);
                        },
                        error: function(error) {
                            console.log(error);
                            toastr.error('Error', "Something went wrong")
                            btn.removeAttr("disabled");
                         
                        }
                       
                    });
                }
            }
        })

        function run(product_id, vendor_id, count)
        {
            // console.log(product_id, count);

            var q = "quantity_" + count;
           

            var quantity = document.getElementById(q).value;
   
            window.location = '/post/agent/buy/' + product_id + '/' +vendor_id + '/'+ quantity; 
        }
</script>
@endsection