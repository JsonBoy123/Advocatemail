<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $table = 'articles';
    protected $primaryKey = 'article_id';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function category(){
        return $this->belongsTo('App\Models\CatgMast','catg_id');
    }

}
