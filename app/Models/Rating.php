<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'user_rating';

    public $timestamps = false;

	protected $guarded = [] ;

 	const id = 'user_id'; 

    public function customers(){
    	return $this->belongsTo('App\Models\User', 'guest_id');
    } 

     public function rate()
    {
         return $this->belongsTo('App\Models\Review');
      
    }

}
