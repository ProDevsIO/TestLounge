<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BookingProduct
 * 
 * @property int $id
 * @property int|null $booking_id
 * @property int|null $product_id
 * @property int|null $vendor_id
 * @property int|null $vendor_product_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property float|null $price
 * 
 * @property Booking|null $booking
 * @property Product|null $product
 * @property Vendor|null $vendor
 * @property VendorProduct|null $vendor_product
 *
 * @package App\Models
 */
class BookingProduct extends Model
{
	protected $table = 'booking_products';

	protected $casts = [
		'booking_id' => 'int',
		'product_id' => 'int',
		'vendor_id' => 'int',
		'vendor_product_id' => 'int',
		'price' => 'float'
	];

	protected $fillable = [
		'booking_id',
		'product_id',
		'vendor_id',
		'vendor_product_id',
		'price'
	];

	public function booking()
	{
		return $this->belongsTo(Booking::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function vendor()
	{
		return $this->belongsTo(Vendor::class);
	}

	public function vendor_product()
	{
		return $this->belongsTo(VendorProduct::class);
	}
}
