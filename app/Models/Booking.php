<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Booking
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $sex
 * @property Carbon|null $dob
 * @property int|null $ethnicity
 * @property string|null $nhs_number
 * @property int|null $vaccination_status
 * @property string|null $vaccination_type
 * @property Carbon|null $vaccination_date
 * @property string|null $document_id
 * @property string|null $address_1
 * @property string|null $address_2
 * @property string|null $home_town
 * @property string|null $post_code
 * @property int|null $home_country_id
 * @property string|null $isolation_address
 * @property string|null $isolation_address2
 * @property string|null $isolation_town
 * @property string|null $isolation_postal_code
 * @property int|null $isolation_country_id
 * @property Carbon|null $arrival_date
 * @property int|null $country_travelling_from_id
 * @property string|null $city_from
 * @property Carbon|null $departure_date
 * @property Carbon|null $last_day_travel
 * @property int|null $method_of_transportation
 * @property string|null $transport_no
 * @property int|null $country_code_id
 * @property string|null $phone_no
 * @property string|null $email
 * @property int|null $consent
 * @property string|null $referral_code
 * @property int|null $user_id
 * @property int|null $mode_of_payment
 * @property int|null $vendor_id
 * @property string|null $booking_code
 * @property string|null $transaction_ref
 * @property int|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Country|null $country
 * @property User|null $user
 * @property Vendor|null $vendor
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Booking extends Model
{
	protected $table = 'bookings';

	protected $casts = [
		'ethnicity' => 'int',
		'vaccination_status' => 'int',
		'home_country_id' => 'int',
		'isolation_country_id' => 'int',
		'country_travelling_from_id' => 'int',
		'method_of_transportation' => 'int',
		'country_code_id' => 'int',
		'consent' => 'int',
		'user_id' => 'int',
		'mode_of_payment' => 'int',
		'vendor_id' => 'int',
		'status' => 'int'
	];

	protected $dates = [
		'dob',
		'arrival_date',
		'departure_date',
		'last_day_travel'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'sex',
		'dob',
		'ethnicity',
		'nhs_number',
		'vaccination_status',
		'vaccination_type',
		'vaccination_date',
		'document_id',
		'address_1',
		'address_2',
		'home_town',
		'post_code',
		'home_country_id',
		'isolation_address',
		'isolation_address2',
		'isolation_town',
		'isolation_postal_code',
		'isolation_country_id',
		'arrival_date',
		'country_travelling_from_id',
		'city_from',
		'departure_date',
		'last_day_travel',
		'method_of_transportation',
		'transport_no',
		'country_code_id',
		'phone_no',
		'email',
		'consent',
		'referral_code',
		'user_id',
		'mode_of_payment',
		'vendor_id',
		'booking_code',
		'transaction_ref',
		'status',
        'stripe_session',
        'stripe_intent',
		'post_status',
        'card_type'
	];

	public function country()
	{
		return $this->belongsTo(Country::class, 'isolation_country_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function vendor()
	{
		return $this->belongsTo(Vendor::class);
	}

	public function homeCountry(){
        return $this->belongsTo(Country::class,'home_country_id');
    }

    public function travelingFrom(){
        return $this->belongsTo(Country::class,'country_travelling_from_id');
    }

    public function transaction(){
	    return $this->hasOne(Transaction::class,'booking_id');
    }

	public function ptransaction(){
	    return $this->hasOne(PoundTransaction::class,'booking_id');
    }

	public function products()
	{
		return $this->belongsToMany(Product::class, 'booking_products')
					->withPivot('id', 'vendor_id', 'vendor_product_id', 'price')
					->withTimestamps();
	}

    public function product()
    {
        return $this->hasOne(BookingProduct::class, 'booking_id');
    }
}
