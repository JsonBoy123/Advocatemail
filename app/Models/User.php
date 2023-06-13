<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use LaratrustUserTrait, HasFactory,Notifiable;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $primaryKey='user_id';

    protected $guarded = [];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        // 'profile_photo_url',
    ];

    public function template(){
        return $this->belongsTo('App\Models\Template','template_id');
    }

   public function customer()
    {
         return $this->hasMany('App\Models\Customer','user_id');
      
    }

    public function reviews(){
        return $this->hasMany('App\Models\Review','user_id');
    }
   
    public function specializations(){
        return $this->belongsToMany('App\Models\Specialization', 'user_specialization','user_id','catg_code');
    }
    public function u_qualifications(){

         return $this->belongsToMany('App\Models\UserQualification', 'user_qual','user_id','qual_code');
    }
    
    public function courts(){
        return $this->belongsToMany('App\Models\Court','user_courts', 'user_id','court_code');
    }

    public function specialities(){
        return $this->hasMany('App\Models\Specialization','user_id');
    }
    public function qualifications(){
        return $this->hasMany('App\Models\UserQualification','user_id');
    }

    public function bookings(){     //For guest
        return $this->hasMany('App\Models\Booking','client_id');
    }
    
    public function isOnline(){
        return Cache::has('user-is-online-'.$this->id);
    }
    public function user_courts(){
        return $this->hasMany('App\Models\Court','user_id');
    }

     public function slots(){
        return $this->hasMany('App\Models\Plans','user_id');;
    }
 
    public function country(){
        return $this->belongsTo('App\Models\Country','country_code')->select('country_code','country_name')->withDefault([
        'country_name' => ' ',
    ]);
    }
    public function state(){
        return $this->belongsTo('App\Models\State','state_code')->select('state_code','state_name')->withDefault([
        'state_name' => ' ',
    ]);
    }
    
    public function city(){
        return $this->belongsTo('App\Models\City','city_code')->select('city_code','city_name')->withDefault([
        'city_name' => ' ',
    ]);
    }
    
    
}
