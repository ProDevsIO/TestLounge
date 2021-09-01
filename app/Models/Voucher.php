<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers';

	protected $fillable = [
		'agent',
        'quantity',
        'transaction_ref',
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
