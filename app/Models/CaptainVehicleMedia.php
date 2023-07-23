<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaptainVehicleMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'captain_vehicle_id', 'image','name','created_at','updated_at'
    ];
    protected $hidden = ['created_at','updated_at'];

    /**
     * Get captainVehicle that owns the Captain Vehicle Media
     *
     * @return void
     */
    public function captainVehicle()
    {
        return $this->belongsTo(CaptainVehicle::class);
    }


}
