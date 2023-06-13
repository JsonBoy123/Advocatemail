<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtMastHeader extends Model
{
    use HasFactory;
    protected $table='court_mast_copy';
    protected $guarded=[];
    protected $primaryKey = 'court_code';
}
