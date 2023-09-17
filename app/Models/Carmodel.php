<?php

namespace App\Models;

use App\Http\Traits\StatusSwitch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carmodel extends Model
{
    use HasFactory, StatusSwitch;
    protected $guarded = [];
    protected $table = 'carmodels';

    public  function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
}
