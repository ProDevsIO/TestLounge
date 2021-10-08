<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoundTransaction extends Model
{
    use HasFactory;
    
	protected $table = 'pound_transactions';

	protected $casts = [
		'amount' => 'float',
		'description'=> 'int',
		'booking_id' => 'int',
		'user_id' => 'int',
		'cost_config' => 'float',
		'pecentage_config' => 'float'
	];

	protected $fillable = [
		'amount',
		'description',
		'booking_id',
		'user_id',
		'type',
		'cost_config',
		'pecentage_config'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

}
