<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    use HasFactory;
    protected $table = 'zip_code';
    protected $fillable = [
       'officename','pincode','divisionname','regionname','circlename','Taluka','Districtname','statename','RelatedSuboffice','RelatedHeadoffice',
    ];
}
