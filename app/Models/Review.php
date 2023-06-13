<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'user_reviews';

    public $timestamps = false;

	protected $guarded = [] ;

 	const id = 'user_id'; 

    public function customers(){
    	return $this->belongsTo('App\Models\User', 'user_id');
    } 

    public function rates(){
        return $this->hasOne('App\Models\Review');
    } 

}
