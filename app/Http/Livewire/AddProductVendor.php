<?php

namespace App\Http\Livewire;

use App\Models\BookingProduct;
use App\Models\Product;
use App\Models\VendorProduct;
use Illuminate\Http\Request;
use Livewire\Component;

class AddProductVendor extends Component
{
    public $vendor_id;
    public $price;
    public $product_id;

    protected $listeners = ['deleteProduct' => 'deleteProduct',"productVendor" => '$refresh'];

    public function render()
    {
        $products = Product::all();
        $vendor_products = VendorProduct::where('vendor_id', $this->vendor_id)->get();
        $vendor_products_array = VendorProduct::where('vendor_id', $this->vendor_id)->pluck('product_id')->toArray();

        return view('livewire.add-product-vendor')->with(compact('products', 'vendor_products', 'vendor_products_array'));
    }

    public function add_product()
    {
        if (!$this->product_id && !$this->price) {
            $this->dispatchBrowserEvent(
                'toastMessage', ['type' => 'error', 'heading' => "Error", 'message' => 'Enter a price or Select a Product']);

            return;
        }

        $vendore_product_ = VendorProduct::where('product_id', $this->product_id)->where('vendor_id', $this->vendor_id)->first();

        if (!$vendore_product_) {
            VendorProduct::create([
                'price' => $this->price,
                'product_id' => $this->product_id,
                'vendor_id' => $this->vendor_id
            ]);
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
