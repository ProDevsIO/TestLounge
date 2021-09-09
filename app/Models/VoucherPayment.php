<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherPayment extends Model
{
    use HasFactory;

    protected $table = 'voucher_payments';

    protected $fillable = [
        'agent',
		'transaction_ref',
        'vendor_id',
        'product_id',
        'vendor_product_id',
        'quantity',
        'charged_amount',
        'currency',
        'status'
	];

    public function user()
	{
		return $this->BelongsTo(User::class, 'agent');
	}
    
    public function voucherProduct()
	{
		return $this->hasOne(VoucherProduct::class);
	}
}
