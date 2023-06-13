<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table='city_mast';
    protected $primaryKey='city_code';
    protected $guarded = [];

    public function users(){
    	return $this->hasMany('App\Models\User','city_code');
    }
}
