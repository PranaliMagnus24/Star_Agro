<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pages extends Model
{
    use HasFactory;
    protected $table = 'cms_pages';
    protected $fillable = ['title','summary','description','image','meta_title','meta_keyword','meta_description','og_title','og_description','og_img','status'];

   
}
