<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Product
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Booking[] $bookings
 * @property Collection|Vendor[] $vendors
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';

	protected $fillable = [
		'name',
		'slug',
		'description',
		'country_id'
	];

	protected static function boot()
    {
        parent::boot();
        static::created(function ($blog) {
            $blog->slug = $blog->initSlug($blog->name);
            $blog->save();
        });
    }

    private function initSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::whereName($name)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
				
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-1";
        }
	
        return $slug;
    }

	public function bookings()
	{
		return $this->belongsToMany(Booking::class, 'booking_products')
					->withPivot('id', 'vendor_id', 'vendor_product_id', 'price')
					->withTimestamps();
	}

	public function vendors()
	{
		return $this->belongsToMany(Vendor::class, 'vendor_products')
					->withPivot('id', 'price')
					->withTimestamps();
	}

	public function voucherCount()
	{
		if(auth()->user()->type == 1){
			return $this->hasMany(VoucherCount::class, 'product_id');
		
		}else{
			return $this->hasOne(VoucherCount::class, 'product_id')->where('agent' ,auth()->user()->id);
		}
	}
	
	public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
