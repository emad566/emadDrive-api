<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaptainBankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'captain_id', 'bank_name', 'iban_number', 'account_name','account_number','is_default', 'status'
    ];

    protected $hidden = ['created_at','updated_at'];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Get Captain Bank Card that belongs to Captain
     *
     * @return void
     */
    public function captain()
    {
        return $this->belongsTo(Captain::class);
    }


}
