<?php

namespace App\Http\Traits;

use App\Models\AppSetting;
use Illuminate\Support\Facades\DB;

trait CaptainScopes
{
    /**
     * scopeActive
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * scope not Active
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeNotActive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * scopeOnline
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeOnline($query)
    {
        return $query->where('available', true);
    }
    /**
     * scope Offline
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeOffline($query)
    {
        return $query->where('available', false);
    }
    /**
     * scope Gender (Male , Female)
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeGender($query, $type)
    {
        return $query->where('gender', $type);
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
     * scope not suspend
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeNotSuspend($query)
    {
        return $query->where('suspend', false);
    }
    /**
     * Get vehicles for the Captain Vehicle
     *
     * @return void
     */
    public function scopeGetVehicle($query)
    {
        return $query->whereHas('vehicles', function ($q) {
            $q->where('is_default', true);
        })->first();
    }
    public function scopeMobile($query, $mobile)
    {
        return $query->where('mobile',$mobile)->orWhere('mobile','966'.$mobile)->orWhere('mobile','966'.(int)$mobile);
    }

    /**
     * makeNormalTrip
     *
     * @param  mixed $request
     * @return void
     */
    public function findCaptionsForTrip($request, $canGetAll = false, $captain_id = null)
    {
        if (isset($request['trip_properties']) && count($request['trip_properties']) > 0) {
            $captains = DB::table('captains')->select('captains.id', 'captains.device_token','captains.mobile')
                ->join('captain_vehicles', function ($join) {
                    $join->on('captains.id', '=', 'captain_vehicles.captain_id')
                        ->where('captain_vehicles.is_default', true);
                })
                ->join('captain_wallets', function ($join) {
                    $join->on('captains.id', '=', 'captain_wallets.captain_id');
                })
                //->join('captain_vehicles', 'captains.id', '=', 'captain_vehicles.captain_id')
                // ->join('captain_routes', 'captains.id', '=', 'captain_routes.captain_id')
                ->join('captain_trip_property', 'captains.id', '=', 'captain_trip_property.captain_id') // deleted
                ->where('captains.is_active', 1)
                //->where('captains.status', 2)
                ->where('captains.available', true)
                ->where('captains.suspend', false)
                ->where('captains.in_trip', false) // available
                //->where('captains.national_expiry_date','>=', now())
                //->where('captains.license_expiry_date','>=', now())
                ->where('captains.id', '!=', $captain_id)
                ->where('captains.mobile','!=',auth()->user()->mobile)
                ->where(function ($q) use ($canGetAll) {
                    if ($canGetAll) {
                        $q->where('captains.is_have_max_amount', '<', (int)AppSetting::CaptainWeaklyMaxAmount());
                    }
                }) // if captain have cache more then felid in db max amount weakly

                //->where('captains.city_id', $request['city_id'])
                //->where('captains.gender', $request['gender'])
                ->where('captain_vehicles.class_id', $request['vehicle_class_id'])
                ->where('captain_vehicles.status', true)
                ->where('captain_vehicles.status_image', true)
                //->where('captain_vehicles.is_default', true)
                //->where('captain_vehicles.vehicle_authorized_expire_date','>=', now())
                //->where('captain_routes.status', true)
                ->where('captain_wallets.balance','>', AppSetting::HeroNegativeWalletLimit())
                ->whereIn('captain_trip_property.property_id', $request['trip_properties'])
                ->havingRaw('COUNT(captain_trip_property.property_id) >= ?', [count($request['trip_properties'])])
                ->get();
        } else {
            $captains = DB::table('captains')->select('captains.id', 'captains.device_token','captains.mobile')
                ->join('captain_vehicles', function ($join) {
                    $join->on('captains.id', '=', 'captain_vehicles.captain_id')
                        ->where('captain_vehicles.is_default', true);
                })
                ->join('captain_wallets', function ($join) {
                    $join->on('captains.id', '=', 'captain_wallets.captain_id');
                })
                //->join('captain_vehicles', 'captains.id', '=', 'captain_vehicles.captain_id')
                // ->join('captain_routes', 'captains.id', '=', 'captain_routes.captain_id')
                //->join('captain_trip_property', 'captains.id', '=', 'captain_trip_property.captain_id') // deleted
                ->where('captains.is_active', 1)
                //->where('captains.status', 2)
                ->where('captains.available', true)
                ->where('captains.suspend', false)
                ->where('captains.in_trip', false) // available
                //->where('captains.national_expiry_date','>=', now())
                //->where('captains.license_expiry_date','>=', now())
                ->where('captains.id', '!=', $captain_id)
                ->where('captains.mobile','!=',auth()->user()->mobile)
                ->where(function ($q) use ($canGetAll) {
                    if ($canGetAll) {
                        $q->where('captains.is_have_max_amount', '<', (int)AppSetting::CaptainWeaklyMaxAmount());
                    }
                })
                //                ->where(function ($q) use ($request) {
                //                if ($request['vehicle_class_id']>0) {
                //                    $q->where('captain_vehicles.class_id',$request['vehicle_class_id']);
                //                }
                //            }) // if captain have cache more then felid in db max amount weakly

                //->where('captains.city_id', $request['city_id'])
                //->where('captains.gender', $request['gender'])
                ->where('captain_vehicles.class_id', $request['vehicle_class_id'])
                ->where('captain_vehicles.status', true)
                ->where('captain_vehicles.status_image', true)
                ->where('captain_wallets.balance','>', AppSetting::HeroNegativeWalletLimit())
                //->where('captain_vehicles.is_default', true)
                //->where('captain_vehicles.vehicle_authorized_expire_date','>=', now())
                //->where('captain_routes.status', true)
                //->where('captain_trip_property.property_id', $request['trip_properties']) // deleted
                ->get();
        }

        # class id 6 (Assistance)
        /*
        if ($request['vehicle_class_id'] == 6 && $captains->isEmpty() == true) {
            $captains = DB::table('captains')->select('captains.id')
                ->join('captain_vehicles', function ($join) {
                    $join->on('captains.id', '=', 'captain_vehicles.captain_id')
                        ->where('captain_vehicles.is_default', true);
                })
                //->join('captain_vehicles', 'captains.id', '=', 'captain_vehicles.captain_id')
                ->join('captain_trip_property', 'captains.id', '=', 'captain_trip_property.captain_id') // deleted
                ->where('captains.is_active', 1)
                //->where('captains.status', 2)
                ->where('captains.available', true)
                ->where('captains.suspend', false)
                ->where('captains.in_trip',false) // available
                ->where('captains.id', '!=', $captain_id)
                ->where(function ($q) use ($canGetAll) {
                    if ($canGetAll) {
                        $q->where('captains.is_have_max_amount', '<', (int)AppSetting::CaptainWeaklyMaxAmount());
                    }
                }) // if captain have cache more then felid in db max amount weakly
                //->where('captains.city_id', $request['city_id'])
                //->where('captains.gender', $request['gender'])
                //->where('captain_vehicles.class_id', 1) ## classic vehicles
                ->where('captain_vehicles.status', true)
                ->where('captain_vehicles.status_image', true)
                //->where('captain_vehicles.is_default', true)
                ->where(function ($q) use ($request) {
                    if ($request['trip_properties']!=0) {
                        $q->where('captain_trip_property.property_id', $request['trip_properties']);
                    }
                })
                //->where('captain_trip_property.property_id', $request['trip_properties']) // deleted
                ->get();
        }
        */
        return json_decode(json_encode($captains), true);
    }

    public function checkAvailableHero(){
        $captains = DB::table('captains')->select('captain_vehicles.class_id')
                ->join('captain_vehicles', function ($join) {
                    $join->on('captains.id', '=', 'captain_vehicles.captain_id')
                        ->where('captain_vehicles.is_default', true);
                })
                ->where('captains.is_active', 1)
                ->where('captains.available', true)
                ->where('captains.suspend', false)
                ->where('captains.in_trip', true) // available
                ->where('captain_vehicles.status', true)
                ->where('captain_vehicles.status_image', true)
                ->groupBy('captain_vehicles.class_id')
                ->pluck('class_id');
                //->get();

        return json_decode(json_encode($captains), true);

    }
}
