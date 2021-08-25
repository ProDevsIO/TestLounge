<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vendor
 * 
 * @property int $id
 * @property string|null $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|BookingProduct[] $booking_products
 * @property Collection|Booking[] $bookings
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Vendor extends Model
{
	protected $table = 'vendors';

	protected $fillable = [
		'name','email'
	];

	public function booking_products()
	{
		return $this->hasMany(BookingProduct::class);
	}

	public function bookings()
	{
		return $this->hasMany(Booking::class);
	}

	public function Carts()
	{
		return $this->belongsToMany(Cart::class);
	}

	public function products()
	{
		return $this->belongsToMany(Product::class, 'vendor_products')
					->withPivot('id', 'price')
					->withTimestamps();
	}

	public function product_get($id){
	    $vendor_product = VendorProduct::where('vendor_id',$this->id)->where('product_id',$id)->first();
	    return $vendor_product;
    }
}
