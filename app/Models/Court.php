<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;
    protected $table = 'user_courts';
    public $timestamps = false;
    protected $guarded = [] ;
    protected $primaryKey = 'court_code';
    public $incrementing =false;

    public function users(){
        return $this->belongsToMany('App\User','user_courts','court_code','user_id');
    }
    public function court_catg(){
        return $this->belongsTo('App\Models\CourtMastHeader','court_code');
    }
}
