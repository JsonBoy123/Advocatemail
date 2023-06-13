<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSummaryView extends Model
{
    use HasFactory;
     protected $table='website_summary_view';
    protected $primaryKey=null;
    protected $guarded = [];
    public $timestamps =false;
    
}
