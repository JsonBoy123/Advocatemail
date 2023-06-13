<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prod extends Model
{
    use HasFactory;
     protected $table='prod_mast';
    protected $primaryKey=null;
    protected $guarded = [];
    public $timestamps =false;
    
}
