<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voucherGenerate extends Model
{
    use HasFactory;

    protected $table = 'voucher_generated';

	protected $fillable = [
		'agent',
        'voucher_count_id',
		'email',
        'voucher',
        'quantity',
        'status'
	];

    public function user()
	{
		return $this->BelongsTo(User::class, 'agent');
	}
    
    public function voucherCount()
	{
		return $this->BelongsTo(VoucherCount::class, 'voucher_count_id');
	}
}
