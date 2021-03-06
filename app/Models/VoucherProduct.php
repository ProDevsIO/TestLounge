<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherProduct extends Model
{
    use HasFactory;

    protected $table = 'voucher_products';

	protected $fillable = [
		'voucher_id',
        'vendor_id',
        'product_id',
        'vendor_product_id',
        'quantity',
        'charged_amount',
        'currency'
	];

    public function voucher()
	{
		return $this->BelongsTo(Voucher::class);
	}

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
