<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentCode
 * 
 * @property int $id
 * @property string|null $code
 * @property int|null $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class PaymentCode extends Model
{
	protected $table = 'payment_codes';

	protected $casts = [
		'created_by' => 'int'
	];

	protected $fillable = [
		'code',
		'created_by'
	];
}
