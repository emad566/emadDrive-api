<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tokenable_id','tokenable_type','token','device_id','device_type'
    ];
    
    /**
     * 
     */
    public function tokenable()
    {
        return $this->morphTo();
    }
}
