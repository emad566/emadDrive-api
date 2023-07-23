<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaptainDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'captain_id', 'file', 'name','status','vehicle_id','created_at','updated_at'
    ];

    protected $hidden = ['created_at','updated_at'];

    /**
     * Get captain that owns the Captain Document
     *
     * @return void
     */
    public function captain()
    {
        return $this->belongsTo(Captain::class);
    }


}
