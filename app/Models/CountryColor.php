<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryColor extends Model
{
    protected $table = 'countrycolor';
    protected $fillable = [

		'country_id',
        'color_id'
	];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

	public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
