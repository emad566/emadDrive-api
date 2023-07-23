<?php

namespace App\Models;

use App\Models\Token;
use App\Http\Traits\CaptainScopes;
use Laravel\Passport\HasApiTokens;
use App\Models\DashboardNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Captain extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable, CaptainScopes;

    protected $guard = 'captain';

    protected $fillable = [
        'is_active', 'suspend', 'available', 'status', 'rate', 'total_km', 'city_id', 'national_expiry_date',
        'license_expiry_date', 'nationality', 'national_id', 'remember_token', 'device_token', 'avatar', 'verified_at',
        'password', 'email', 'country_code', 'mobile', 'blood_type', 'birthplace','in_trip',
        'birthday', 'gender', 'full_name', 'captain_code', 'register_step', 'rank', 'is_dark_mode', 'lang','is_have_max_amount'
    ];
    
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return getFLName($this->full_name);
    }

    /**
     * Get  token of Captain.
     */
    public function tokenable()
    {
        return $this->morphMany(Token::class, 'tokenable');
    }

    /**
     * Get city that belongs to Captain .
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }


    /**
     * Get vehicles for the Captain Vehicle
     *
     * @return void
     */
    public function vehicles()
    {
        return $this->hasMany(CaptainVehicle::class);
    }


    /**
     * Get captain for the bank Card
     *
     * @return void
     */
    public function bankCard()
    {
        return $this->hasMany(CaptainBankCard::class);
    }
    /**
     * Get documents for the Captain Document
     *
     * @return void
     */
    public function documents()
    {
        return $this->hasMany(CaptainDocument::class);
    }

    /**
     * Get all media of product.
     */
    public function vehicleMedias()
    {
        return $this->morphMany(VehicleMedia::class, 'vehicleMediable');
    }
    /**
     * The tripProperties that belong to the captain.
     */
    public function tripProperties()
    {
        return $this->belongsToMany(Property::class, 'captain_trip_property', 'captain_id', 'property_id');
    }
    /**
     * The wallet that belong to the captain
     *
     * @return void
     */
    public function wallet()
    {
        return $this->hasOne(CaptainWallet::class);
    }

    /**
     * The myRoute that belong to the captain 
     * captain can put path ex from home - work 
     * to get trip in this path 
     * @return void
     */
    public function myRoute()
    {
        return $this->hasOne(CaptainRoute::class)->orderBy('id', 'DESC');
    }
    /**
     * Get  Rate of captains.
     */
    public function rateableTrip()
    {
        return $this->morphMany(RateTrip::class, 'rateableTrip');
    }

    /**
     * Get  Cancel of captains.
     */
    public function cancelable()
    {
        return $this->morphMany(CancelReason::class, 'cancelable');
    }
    /**
    
     */
    public function socialMedias()
    {
        return $this->hasMany(SocialMedia::class, 'user_id')->where('user_type', 'captain');
    }
    /**
     * Get the captains's blocked.
     */
    public function blockable()
    {
        return $this->morphMany(Block::class, 'blockable');
    }

    /**
     * Get the captains's Logs.
     */
    public function logable()
    {
        return $this->morphMany(BugLog::class, 'userable');
    }
    /**
     * Get the captains's Logs.
     */
    public function log()
    {
        return $this->morphOne(BugLog::class, 'userable');
    }

    public function reference()
    {
        return $this->belongsToMany(
            self::class,
            'captain_reference',
            'reference_id',
            'captain_id'
        );
    }
    // public function captain()
    // {
    //     return $this->belongsToMany(
    //         self::class,
    //         'captain_reference',
    //         'reference_id',
    //         'captain_id'
    //     );
    // }

    public function wasl()
    {
        return $this->hasOne(WaslDrivers::class);
    }

    /**
     * Get trips for the Captain
     *
     * @return void
     */
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }


}
