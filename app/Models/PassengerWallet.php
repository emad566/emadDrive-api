<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassengerWallet extends Model
{
    use HasFactory;
    protected $fillable = ['passenger_id', 'balance','status'];

    /**
    * passenger
    *
    * @return void
    */
   public function passenger()
   {
       return $this->belongsTo(Passenger::class);
   }
}
