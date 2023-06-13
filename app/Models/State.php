<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
     protected $table='state_mast';
    protected $primaryKey='state_code';
    protected $guarded = [];
    
    public function users(){
       return  $this->hasMany('App\Models\User','state_code','state_code');
    }
}
