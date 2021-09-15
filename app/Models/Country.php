<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $iso
 * @property string $name
 * @property string $nicename
 * @property string|null $iso3
 * @property int|null $numcode
 * @property int $phonecode
 * 
 * @property Collection|Booking[] $bookings
 *
 * @package App\Models
 */
class Country extends Model
{
	protected $table = 'countries';
	public $timestamps = false;

	protected $casts = [
		'numcode' => 'int',
		'phonecode' => 'int'
	];

	protected $fillable = [
		'iso',
		'name',
		'nicename',
		'iso3',
		'numcode',
		'phonecode'
	];

	public function bookings()
	{
		return $this->hasMany(Booking::class, 'isolation_country_id');
	}

	public function countryColor()
    {
        return $this->hasOne(Country::class);
    }


}
