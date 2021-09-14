<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * 
 * @property int $id
 * @property float|null $amount
 * @property int|null $description
 * @property int|null $booking_id
 * @property int|null $user_id
 * @property float|null $cost_config
 * @property float|null $pecentage_config
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Transaction extends Model
{
	protected $table = 'transactions';

	protected $casts = [
		'amount' => 'float',
		'description' => 'int',
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
}
