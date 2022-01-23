<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterTest extends Model
{
    use HasFactory;

    protected $fillable = [
		'barcode',
		'date_of_sampling',
		'result_observed',
		'picture',
		'type_of_test',
		'greenCountryConsent',
        'first_name',
		'last_name',
        'address',
        'flat_number',
        'postal_code',
        'city',
        'phone',
        'email',
		'gender',
		'ethnicity',
		'dob',
        'passport_number',
		'symptoms',
        'travel_type',
        'flightNumber',
        'arrivalDate',
        'countryVisited',
        'vaccination',	
        'termsConsent',
	
	];
}
