<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherDiscount extends Model
{
    use HasFactory;
    
    
	protected $table = 'voucher_discounts';

	protected $casts = [
		'amount' => 'float',
		'v_pay_id' => 'int',
		'user_id' => 'int',
		'cost_config' => 'float',
		'pecentage_config' => 'float'
	];

	protected $fillable = [
		'amount',
        'v_pay_id',
        'user_id',
        'cost_config',
        'pecentage_config',
        'currency'
	];

    public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function v_pay()
	{
		return $this->hasOne(VoucherPayment::class, 'id', 'v_pay_id');
	}

}
