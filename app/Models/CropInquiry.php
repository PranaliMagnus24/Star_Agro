<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CropInquiry extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'crops_inquiry';
    protected $fillable = ['name', 'email', 'mobile_number','crop_management_id','crop_name','description','city',

];


public function city()
{
    return $this->belongsTo(City::class, 'city', 'id');
}

}
