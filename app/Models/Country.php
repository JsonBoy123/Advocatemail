<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
     protected $table='country_mast';
    protected $primaryKey='country_code';
    protected $guarded = [];
}
