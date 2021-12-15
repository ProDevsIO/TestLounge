<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportedCountriesTest extends Model
{
    use HasFactory;
    protected $fillable = [
		'country_id',
        'test_type_id',
	];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'country_id','country_id');
    }
}
