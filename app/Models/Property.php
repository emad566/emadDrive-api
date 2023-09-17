<?php

namespace App\Models;

use App\Http\Controllers\General\ConstantController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Property extends Model
{
    use HasFactory;
    protected $table='properties';
    protected $fillable=[
        'ar_title',
        'en_title',
        'icon',
        'status'
    ];

    public function getStatusSwitchAttribute(){
        return $this->status ? 'checked="checked"' : '';
    }

    function getIconSrcAttribute(): string
    {
        $src = 'storage/'.$this->icon;
        return (file_exists(public_path($src)) && $this->icon)? asset($src) : asset(ConstantController::NO_IMAGE);
    }
}
