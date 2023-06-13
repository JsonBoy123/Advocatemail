<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_State_View extends Model
{
    use HasFactory;
    protected $connection= 'mysql';

    protected $table = 'user_state_view';
    protected $guarded = [];
}
