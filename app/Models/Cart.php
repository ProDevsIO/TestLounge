<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
		'ip',
		'quantity',
        'vendor_product_id'
	];

 

    public function product()
	{
		return $this->hasOne(Product::class, 'id');
	}

    public function vendorProduct()
	{
		return $this->belongsTo(VendorProduct::class);
	}
}
