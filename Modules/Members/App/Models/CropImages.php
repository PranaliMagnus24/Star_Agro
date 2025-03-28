<?php

namespace Modules\Members\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Members\Database\factories\CropImagesFactory;

class CropImages extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'crop_images';
    protected $fillable = ['crop_images','crop_id','farmer_id'];

    protected static function newFactory(): CropImagesFactory
    {
        //return CropImagesFactory::new();
    }
}
