<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pages extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'cms_pages';
    protected $fillable = ['title', 'slug','summary','description','image','meta_title','meta_keyword','meta_description','og_title','og_description','og_img','status'];

   
}
