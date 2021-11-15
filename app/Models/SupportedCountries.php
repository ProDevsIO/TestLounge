<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportedCountries extends Model
{
    use HasFactory;

    protected $table = 'supported_countries';

	protected $fillable = [
		'country_id',
		'vendor_id',
        'arrival_vaccinated',
        'arrival_unvaccinated',
        'departure_vaccinated',
        'departure_unvaccinated',
		'faq',
	];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
