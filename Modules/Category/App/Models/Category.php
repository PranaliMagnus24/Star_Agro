<?php

namespace Modules\Category\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Database\factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'categories';

    protected $fillable = ['category_name', 'description', 'status','parent_id','subcategory_id'];


    protected static function newFactory(): CategoryFactory
    {
        //return CategoryFactory::new();
    }
}
