<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherCount extends Model
{
    use HasFactory;

    protected $table = 'voucher_counts';

	protected $fillable = [
		'agent',
		'product_id',
        'quantity',
	];

    public function user()
	{
		return $this->BelongsTo(User::class, 'agent');
	}
    

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function voucherGenerate()
    {
        return $this->hasMany(VoucherGenerate::class);
    }

}
