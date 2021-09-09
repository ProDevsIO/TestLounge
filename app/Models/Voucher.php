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
		'email',
        'quantity',
        'transaction_ref',
		'type',
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
