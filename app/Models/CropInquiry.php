<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CropInquiry extends Model
{
    use HasFactory;
    protected $table = 'crops_inquiry';
    protected $fillable = ['name', 'email', 'mobile_number','crop_management_id','crop_name','description','city',

];
}
