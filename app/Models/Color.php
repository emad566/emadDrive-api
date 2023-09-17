<?php

namespace App\Models;

use App\Http\Traits\StatusSwitch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory, StatusSwitch;
    protected $guarded = [];
    protected $table = 'colors';
}
