<?php

namespace App\Http\Livewire;

use App\Models\BookingProduct;
use App\Models\Product;
use App\Models\Setting;
use App\Models\VendorProduct;
use Illuminate\Http\Request;
use App\Models\TestType;
use Livewire\Component;

class AddProductVendor extends Component
{
    public $vendor_id;
    public $price;
    public $product_id;
    public $price_stripe;
    public $costPrice;
    public $pound_price;
    public $alternativePrice;
    public $walkProductid;
    public $types;

    protected $listeners = ['deleteProduct' => 'deleteProduct',"productVendor" => '$refresh'];

    public function render()
    {
        $products = Product::all();
        $vendor_products = VendorProduct::where('vendor_id', $this->vendor_id)->orderby('product_id')->get();
        $vendor_products_array = VendorProduct::where('vendor_id', $this->vendor_id)->pluck('product_id')->toArray();
        $types = TestType::all();
        $pound_price = $this->pound_price;
        $vendor_id =  $this->vendor_id;

        return view('livewire.add-product-vendor')->with(compact('products', 'vendor_products', 'vendor_products_array', 'pound_price','types', 'vendor_id'));
    }

    public function add_product()
    {
   
        if (!$this->types) {
            $this->dispatchBrowserEvent(
                'toastMessage', ['type' => 'error', 'heading' => "Error", 'message' => "No test type available for this product"]);

            return;
        }

        if (!$this->product_id || !$this->price || !$this->costPrice || !$this->types) {
            $this->dispatchBrowserEvent(
                'toastMessage', ['type' => 'error', 'heading' => "Error", 'message' => "Enter a price or Select a Product $this->price_stripe"]);

            return;
        }

        $vendore_product_ = VendorProduct::where('product_id', $this->product_id)
                                        ->where('vendor_id', $this->vendor_id)
                                        ->where('test_type_id', $this->types)
                                        ->first();
       
        $pounds_value = Setting::first();
        
        if (!$vendore_product_) {
            $v = VendorProduct::create([
                'price_pounds' => $this->price,
                'price' => $this->price * $pounds_value->pounds,
                'price_stripe' => $this->price_stripe,
                'product_id' => $this->product_id,
                'cost_price' =>$this->costPrice,
                'vendor_id' => $this->vendor_id,
                'alternative_price' => $this->alternativePrice,
                'walk_product_id' => $this->walkProductid,
                'test_type_id' => $this->types
            ]);

           
        }else{
            $this->dispatchBrowserEvent(
                'toastMessage', ['type' => 'error', 'heading' => "Error", 'message' => 'This type of test for this product already exist']);
        }

        $this->price = "";

        $this->dispatchBrowserEvent(
            'toastMessage', ['type' => 'success', 'heading' => "Success", 'message' => 'Product has been add successfully']);


    }

    public function deleteProduct($id){


        $booking_products = BookingProduct::where('vendor_product_id',$id)->count();

        if($booking_products == 0){
            VendorProduct::where('id',$id)->delete();

            $this->dispatchBrowserEvent(
                'toastMessage', ['type' => 'success', 'heading' => "Success", 'message' => 'Product has been deleted successfully']);
        }

    }
}
