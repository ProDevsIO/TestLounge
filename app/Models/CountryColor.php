<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryColor extends Model
{
    protected $fillable = [
		'booking_id',
		'product_id',
		'vendor_id',
		'vendor_product_id',
		'price'
	];

    public function country()
    {
        return $this->belongsToMany(Country::class);
    }

	public function color()
    {
        return $this->HasOne(Color::class);
    }
}
