<?php

namespace App\Models;

use App\Http\Controllers\General\ConstantController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleClasses extends Model
{
    use HasFactory;
    protected $table='vehicle_classes';
    protected $guarded =[];

    public function getStatusSwitchAttribute(){
        return $this->status? 'checked="checked"' : '';
    }

    public function getStatusAttribute($value){
        return $value? true : false;
    }

    function getIconSrcAttribute(): string
    {
        $src = 'storage/'.$this->icon;
        return (file_exists(public_path($src)) && $this->icon)? asset($src) : asset(ConstantController::NO_IMAGE);
    }
}
