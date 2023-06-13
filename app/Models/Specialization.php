<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
   	protected $table = 'specializations';
	public $timestamps = false;
	protected $guarded = [] ;
 	protected $primaryKey = 'user_id';
 	public $incrementing =false;

 	public function users(){
 		return $this->belongsToMany('App\Models\User','user_specialization','catg_code', 'spec_name','user_id');
 	}
 	public function user_specialization(){
 		return $this->belongsToMany('App\Models\user_specialization','catg_code');
 	}
}
