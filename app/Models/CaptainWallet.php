<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaptainWallet extends Model
{
    use HasFactory;

    protected $fillable = ['captain_id', 'balance','status'];


     /**
     * captain
     *
     * @return void
     */
    public function captain()
    {
        return $this->belongsTo(Captain::class);
    }
}
