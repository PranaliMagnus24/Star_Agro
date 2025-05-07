<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointsSetting extends Model
{
    use HasFactory;
    protected $table = "points_settings";

    
    protected $fillable = ['points_per_inquiry'];
}
