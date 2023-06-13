<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtMast extends Model
{
    use HasFactory;
    protected $table='court_mast';
    protected $primaryKey='court_code';
    protected $guarded = [];
    public $timestamps =false;
}
