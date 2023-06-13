<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourt extends Model
{
    use HasFactory;
     protected $table='user_courts';
    protected $primaryKey=null;
    protected $guarded = [];
    public $timestamps =false;
    public function court_catg(){
 		return $this->belongsTo('App\Models\CourtMast','court_code');
 	}
}
