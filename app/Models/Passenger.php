<?php

namespace App\Models;

use App\Models\DonationSide;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Passenger extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $guard = 'passenger';

    protected $fillable = [
        'passenger_code',
        'donation',
        'donation_id',
        'full_name',
        'gender',
        'mobile',
        'country_code',
        'email',
        'password',
        'verified_at',
        'avatar',
        'city_id',
        'remember_token',
        'device_token',
        'shake_phone',
        'health_condition_id',
        'rate',
        'vat',
        'status',
        'suspend',
        'is_dark_mode',
        'lang',
    ];

   // public $with = ['favorites'];

   protected static function booted()
   {
       static::created(function ($passenger) {
           $passenger->update(['avatar'=> defaultPassengerAvatar()]);
       });
   }
    /**
     * Get Blind passenger
     *
     * @return void
     */
    public function scopeLogin($query)
    {
       // return $query->whereId(Auth::guard('passenger')->id()); ##Blind
        return $query->find(Auth::guard('passenger')->id()); ##Blind
    }
  /**
     * Get Blind passenger
     *
     * @return void
     */
    public function scopeBlind($query)
    {
        return $query->where('health_condition_id',2)->select('health_condition_id'); ##Blind
    }
    /**
     * scope suspend
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeSuspend($query)
    {
        return $query->where('suspend', true);
    }
    /**
     * Get  Token of Passenger.
     */
    public function tokenable()
    {
        return $this->morphMany(Token::class, 'tokenable');
    }


    /**
     * Get City that belongs to Passenger .
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get Health Condition that belongs to Passenger .
     */
    public function healthCondition()
    {
        return $this->belongsTo(HealthCondition::class);
    }

    /**
     * Get favorite that belongs to Passenger .
     *
     * @return void
     */
    public function favorites()
    {
        return $this->hasMany(FavoritePassenger::class);
    }

    /**
     * The wallet that belong to the Passenger
     *
     * @return void
     */
    public function wallet()
    {
        return $this->hasOne(PassengerWallet::class);
    }

    /**
     * Get BusinessAccount that belongs to Passenger .
     *
     * @return void
     */
    public function businessAccount()
    {
        return $this->hasOne(BusinessAccount::class);
    }
    /**
     * Get BusinessAccount that belongs to Passenger .
     *
     * @return void
     */
    public function businessGroup()
    {
        return $this->belongsToMany(BusinessGroup::class, 'business_group_members', 'passenger_id', 'business_group_id');
    }
     /**
     * Get BusinessAccount that belongs to Passenger .
     *
     * @return void
     */
    public function addBusinessGroup()
    {
        return $this->belongsToMany(BusinessGroup::class, 'business_group_members', 'passenger_id', 'business_group_id')->Where('type',2);
    }

    /**
     * Get BusinessAccount that belongs to Passenger .
     *
     * @return void
     */
    public function businessGroupWallet()
    {
        return $this->hasOne(BusinessPassengerWallet::class);
    }
    // /**
    //  * Get BusinessAccount that belongs to Passenger .
    //  *
    //  * @return void
    //  */
    // public function businessGroupPending()
    // {
    //     return $this->hasMany(BusinessGroupPendingMember::class, 'passenger_id');
    // }
      /**
     * Get BusinessAccount that belongs to Passenger .
     *
     * @return void
     */
    public function businessGroupPending()
    {
        return $this->belongsToMany(BusinessGroup::class,'business_group_members','passenger_id','business_group_id')->wherePivot('type',0);
    }

    /**
     * Get BusinessAccount that belongs to Passenger .
     *
     * @return void
     */
    public function familyAccounts()
    {
        return $this->hasMany(Family::class);
    }
    /**
     * Get BusinessAccount that belongs to Passenger .
     *
     * @return void
     */
    public function familyRelative()
    {
        return $this->belongsToMany(Family::class, 'family_relatives', 'passenger_id', 'family_id')->withPivot('type');
    }
    /**
     * Get BusinessAccount that belongs to Passenger .
     *
     * @return void
     */
    public function familyGroupPending()
    {
        return $this->belongsToMany(Family::class, 'family_relatives', 'passenger_id', 'family_id')->wherePivot('type',0);
    }
    // /**
    //  * Get BusinessAccount that belongs to Passenger .
    //  *
    //  * @return void
    //  */
    // public function familyGroupPending()
    // {
    //     return $this->hasMany(FamilyPendingRelative::class, 'passenger_id');
    // }
    //  /**
    //  * Get BusinessAccount that belongs to Passenger .
    //  *
    //  * @return void
    //  */
    // public function familyGroupPending()
    // {
    //     return $this->hasMany(Family::class, 'passenger_id');
    // }

    /**
     * Get trips that belongs to Passenger .
     *
     * @return void
     */
    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'passenger_trip', 'passenger_id', 'trip_id')
            ->withPivot('pickup_location_name', 'pickup_lat', 'pickup_lng')
            ->withTimestamps();
    }
    /**
     * Get trips that belongs to Passenger .
     *
     * @return void
     */
    public function scheduleTrips()
    {
        return $this->hasMany(ScheduleTrip::class, 'passenger_id');

    }
    /**
     * Get  Rate of Passenger.
     */
    public function rateableTrip()
    {
        return $this->morphMany(RateTrip::class, 'rateableTrip');
    }
    /**
     * get paymentMethods belongs To many Passenger
     *
     * @return void
     */
    public function paymentMethods()
    {
        return $this->belongsToMany(PaymentMethod::class, 'passenger_payment_methods', 'passenger_id', 'payment_method_id')
            ->withPivot('status');
    }

    public  function donations(){
        return $this->belongsToMany(DonationSide::class,'donation_transactions',
        'user_id','donation_side'
        )->withPivot('amount');
    }
    public function donation_side(){
        return $this->belongsTo(DonationSide::class,'donation_id');
    }

    /**
     * Get  Cancel of Passenger.
     */
    public function cancelable()
    {
        return $this->morphMany(CancelReason::class, 'cancelable');
    }

    /**
     * Get  Cancel of Passenger.
     */
    public function defaultLocation()
    {
        return $this->hasOne(DefaultLocationPassenger::class);
    }
    /**
     * Get  Cancel of Passenger.
     */
    public function defaultVehicleClass()
    {
        return $this->hasOne(DefaultVehicleClassPassenger::class);
    }
     /**
     * Get BusinessAccount that belongs to Passenger .
     *
     * @return void
     */
    public function myTrustedAccounts()
    {
        return $this->hasMany(TrustedAccount::class,'owner_id');
    }

    //    /**
    //  * Get BusinessAccount that belongs to Passenger .
    //  *
    //  * @return void
    //  */
    // public function trustedRelative()
    // {
    //     return $this->belongsToMany(Family::class, 'trusted_accounts','passenger_id','owner_id')->wherePivot('status','available');
    // }
     /**
     * get health Conditions belongs To Health Condition
     *
     * @return void
     */
    public function trustedMember()
    {
        return $this->belongsToMany(Passenger::class,'trusted_accounts','passenger_id','owner_id')->withPivot('status')->wherePivot('status','pending');
    }
     /**
     * get health Conditions belongs To Health Condition
     *
     * @return void
     */
    public function availableTrustedMembers()
    {
        return $this->belongsToMany(Passenger::class,'trusted_accounts','owner_id','passenger_id')->withPivot('status')->wherePivot('status','available');
    }
    /**
     * get health Conditions belongs To Health Condition
     *
     * @return void
     */
    public function pendingTrustedMembers()
    {
        return $this->belongsToMany(Passenger::class,'trusted_accounts','owner_id','passenger_id')->withPivot('status')->wherePivot('status','pending');
    }
     /**
     * get health Conditions belongs To Health Condition
     *
     * @return void
     */
    public function rejectedTrustedMembers()
    {
        return $this->belongsToMany(Passenger::class,'trusted_accounts','owner_id','passenger_id')->withPivot('status')->wherePivot('status','rejected');
    }

    /**
     * get health Conditions belongs To Health Condition
     *
     * @return void
     */
    public function myPendingTrustedRequest()
    {
        return $this->hasMany(TrustedAccount::class,'passenger_id')
        ->where('status','pending')->where('passenger_id',Auth::guard('passenger')->id());
    }
     /**
     * Get socialMedias that belongs to Passenger .
     *
     * @return void
     */
    public function socialMedias()
    {
        return $this->hasMany(SocialMedia::class,'user_id')->where('user_type','passenger');
    }
    /**
     * Get BusinessAccount that belongs to Passenger .
     *
     * @return void
     */
    public function bankCards()
    {
        return $this->hasMany(BankCardPassenger::class, 'passenger_id');
    }
    //  /**
    //  * Get BusinessAccount that belongs to Passenger .
    //  *
    //  * @return void
    //  */
    // public function defaultBankCard()
    // {
    //     return $this->hasOne(DefaultBankCardPassenger::class);
    // }
      /**
     * Get BusinessAccount that belongs to Passenger .
     *
     * @return void
     */
    public function defaultPaymentMethod()
    {
        return $this->hasOne(DefaultPaymentMethodPassenger::class);
    }
        /**
     * Get forgetItem that belongs To Many Trip . // Passenger add
     *
     * @return void
     */
    public function forgetItem()
    {
        return $this->belongsToMany(Trip::class, 'forget_items', 'passenger_id', 'trip_id')->withTimestamps();
    }
     /**
     * Get the passenger's blocked.
     */
    public function blockable()
    {
        return $this->morphMany(Block::class, 'blockable');
    }
    /**
     * Get the passenger's Logs.
     */
    public function logable()
    {
        return $this->morphMany(BugLog::class, 'userable');
    }
    /**
     * Get the passenger's Logs.
     */
    public function log()
    {
        return $this->morphOne(BugLog::class, 'userable');
    }

    /**
     * Get  notifiable of Passenger.
     */
    public function notifiable()
    {
        return $this->morphMany(DashboardNotification::class, 'notifiable');
    }
}
