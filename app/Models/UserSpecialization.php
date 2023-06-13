<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSpecialization extends Model
{
    use HasFactory;
    protected $table='user_specialization';
    protected $primaryKey=null;
    protected $guarded = [];
    public $timestamps =false;
    

    public function specialization(){
 		return $this->belongsTo('App\Models\Specialization','spec_code','spec_name');
 	}

    public function speci()
    {
        return $this->belongsTo('App\Models\Specialization','catg_code','spec_code');
    }
 	
}
