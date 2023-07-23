<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CaptainVehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'captain_id', 'registration_plate', 'brand', 'model', 'color', 'model_date', 'status', 'is_default'
    ];

    public $with = ['vehicleMedias'];
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
    /**
     * Get captain that owns the CaptainVehicle
     *
     * @return void
     */
    public function captain()
    {
        return $this->belongsTo(Captain::class);
    }


    /**
     * Get Vehicle Medias for the CaptainVehicle
     *
     * @return void
     */
    public function vehicleMedias()
    {
        return $this->hasMany(CaptainVehicleMedia::class);
    }

}
