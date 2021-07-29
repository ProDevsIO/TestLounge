<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VendorProduct
 * 
 * @property int $id
 * @property string|null $price
 * @property int|null $product_id
 * @property int|null $vendor_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Vendor|null $vendor
 * @property Product|null $product
 * @property Collection|BookingProduct[] $booking_products
 *
 * @package App\Models
 */
class VendorProduct extends Model
{
	protected $table = 'vendor_products';

	protected $casts = [
		'product_id' => 'int',
		'vendor_id' => 'int'
	];

	protected $fillable = [
		'price',
		'price_pounds',
		'price_stripe',
		'product_id',
		'vendor_id'
	];

	public function vendor()
	{
		return $this->belongsTo(Vendor::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function booking_products()
	{
		return $this->hasMany(BookingProduct::class);
	}
}
