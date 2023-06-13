<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
     protected $guarded = [];
     protected $table = 'referrals';

    public function state(){
        return $this->belongsTo('App\Models\State','state_code');
    }
    public function city(){
        return $this->belongsTo('App\Models\City','city_code');
    }

}
