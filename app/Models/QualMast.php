<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualMast extends Model
{
    use HasFactory;
    protected $table='qual_mast';
    protected $primaryKey='qual_code';
    protected $guarded = [];
    public $timestamps =false;
}
