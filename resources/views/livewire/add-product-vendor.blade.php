<div>
    <label>Products</label>
    <select wire:model="product_id" class="form-control">
        <option value="">Make a Selection</option>
        @foreach($products as $product)
            @if(!in_array($product->id,$vendor_products_array))
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endif
        @endforeach
    </select>
    <label>Selling Price(£)</label>
    <input type="number" wire:model="price" class="form-control" placeholder="Input number">
    <label>Vendor's Cost Price(£)</label>
    <input type="number" wire:model="costPrice" class="form-control" placeholder="Input number">
    <label>Alternative price</label>
    <input type="text" wire:model="alternativePrice" class="form-control" placeholder="Please input alternative price">

    <!-- <label>Price Stripe</label> -->
    <input type="hidden" value="123" wire:model="price_stripe" class="form-control" placeholder="Price_">
    </select>
    <br/>
    <div wire:loading wire:target="add_product" class="pull-right">
        <img src="/img/ajax-loader.gif" style="height: 35px;"/>
    </div>

    <button type="submit" wire:click="add_product" class="btn btn-primary">Add Product</button>
    <hr>

    @if($vendor_products->count() > 0)
        <h3>Added Products</h3>



            @foreach($vendor_products as $vendor_product)

                    {{ optional($vendor_product->product)->name }}:
                    ${{ number_format($vendor_product->price_pounds,2) }} - (N{{number_format($vendor_product->price,2) }})<br>Cost price:  (£{{number_format($vendor_product->cost_price,2) }}) <br>
                    <a href="javascript:;" class="btn btn-sm btn-info" onclick="change_product('{{ $vendor_product->id }}')"><i
                                    class="fa fa-edit"></i> edit</a>
                        <a href="javascript:;" class="btn btn-danger btn-sm"onclick="closeProduct('{{ $vendor_product->id }}')"><i
                                    class="fa fa-close"></i> Delete</a>

<br>
                <div class="vendor_product_{{ $vendor_product->id }}" style="display: none">
                    <label> Selling Price(£)</label>
                    <input type="number" class="form-control" id="price{{ $vendor_product->id }}">
                    <label>Vendor's Cost Price(£)</label>
                    <input type="text" class="form-control" id="costPrice{{ $vendor_product->id }}">
                    <label>Alternative price</label>
                    <input type="text" value="{{ $vendor_product->alternative_price}}" id="alternativePrice{{ $vendor_product->id }}" class="form-control" >
                    <!-- <label>Price Stripe</label> -->
                    <input type="hidden" value="{{ $vendor_product->price_pounds}}" class="form-control" id="priceStripe{{ $vendor_product->id }}">
<br/>
                    <input type="submit" class="btn btn-primary pull-right" value="update" onclick="productUpdate('{{ $vendor_product->id }}')">
                </div>
                <br>
                <hr>
            @endforeach



    @endif
</div>

<script>
    function change_product(id) {
        $(".vendor_product_"+ id).toggle();
    }

    function productUpdate(id) {
        var d = $("#price" + id).val();
        var s = $("#priceStripe" + id).val();
        var c = $("#costPrice" + id).val();
        var a =  $("#alternativePrice" + id).val();
        var w =  $("#walkProductid" + id).val();

        $.get("/product/vendor/" + id + "/" + d + "/" + s + "/" + c+"/"+ a + "/" + w, function (data, status) {
            $(".vendor_product_"+id).toggle();
            Livewire.emit('productVendor');

            $.toast({
                heading: "success",
                text: "Price has been updated successfully",
                showHideTransition: 'slide',
                icon: "success",
                loaderBg: '#f96868',
                position: 'top-right'
            })
        });


    }


    function closeProduct(id) {
        var d = confirm("Do you want to delete this product?");

        if (d) {
            Livewire.emit('deleteProduct', {
                'id': id
            });
        }
    }
</script>
