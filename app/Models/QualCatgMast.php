<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualCatgMast extends Model
{
    use HasFactory;
    protected $table='qual_catg_mast';
    protected $primaryKey='qual_catg_code';
    protected $guarded = [];
    public $timestamps =false;
}
