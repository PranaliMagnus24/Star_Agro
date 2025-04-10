<?php

namespace Modules\Category\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Database\factories\CategoryFactory;
use Modules\Members\App\Models\CropManagement;
// use Laravel\Scout\Searchable;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'categories';

    protected $fillable = ['category_name','category_image', 'description', 'status','parent_id','subcategory_id'];


    protected static function newFactory(): CategoryFactory
    {
        //return CategoryFactory::new();
    }

    public function cropManagements()
    {
        return $this->hasMany(CropManagement::class, 'crop_id');
    }


    // public function toSearchableArray()
    // {
    //     return [
    //         'category_name' => $this->category_name,
    //         'description' => $this->description,
    //         'status' => $this->status,
    //     ];
    // }


}
