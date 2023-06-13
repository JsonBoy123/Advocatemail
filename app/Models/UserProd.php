<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProd extends Model
{
    use HasFactory;
     protected $table='user_prod';
    protected $primaryKey=null;
    protected $guarded = [];
    public $timestamps =false;
        public function user_id(){
        return $this->belongsTo('App\Models\User','id');
    }
}
