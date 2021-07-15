<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Booking[] $bookings
 * @property Collection|Vendor[] $vendors
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';

	protected $fillable = [
		'name',
		'description'
	];

	public function bookings()
	{
		return $this->belongsToMany(Booking::class, 'booking_products')
					->withPivot('id', 'vendor_id', 'vendor_product_id', 'price')
					->withTimestamps();
	}

	public function vendors()
	{
		return $this->belongsToMany(Vendor::class, 'vendor_products')
					->withPivot('id', 'price')
					->withTimestamps();
	}
}
