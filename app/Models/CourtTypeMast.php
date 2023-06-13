<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtTypeMast extends Model
{
    use HasFactory;
    protected $table='court_type_mast';
    protected $primaryKey='court_type';
    protected $guarded = [];
    public $timestamps =false;
}
