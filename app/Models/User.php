<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
/**
 * Class User
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $password
 * @property string|null $referal_code
 * @property string|null $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Booking[] $bookings
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

	protected $table = 'users';

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'email',
        'phone_no',
		'password',
		'referal_code',
        'company',
        'verified',
		'type','wallet_balance',
        'vendor_id', 'account_bank',
        'account_no','flutterwave_key',
        'country','account_name',
        'total_credit','bank',
        'flutterwave_id','agent_show_name',
        'director','c_o_i',
        'certified','certified_no',
        'platform_name',
        "main_agent_share_percent",
        "main_agent_share_raw",
        "main_agent_id",
        "percentage_split"

	];

	public function bookings()
	{
		return $this->hasMany(Booking::class);
	}

    public function country_residence()
    {
        return $this->belongsTo(Country::class);
    }

    public function voucher()
	{
		return $this->hasOne(Voucher::class);
	}

    public function cbookings()
    {
        return $this->hasMany(Booking::class)->where('status','1');
    }

    public function pbookings()
    {
        return $this->hasMany(Booking::class)->where('status','!=','1');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function ptransactions()
    {
        return $this->hasMany(PoundTransaction::class);
    }

    public function myPercent()
    {
       return  shareHelper()->myShare($this);
    }

    public function superAgent()
    {
        return $this->belongsTo(User::class , "main_agent_id" , "id");
    }

    public function superAgentShare()
    {
        if(!empty($main = $this->main_agent_share_raw)){
            return shareHelper()->calculateMainAgentShare( $main , $this->myPercent());
        }
    }

    public function isAdmin()
    {
       return $this->type == 1;
    }

}
