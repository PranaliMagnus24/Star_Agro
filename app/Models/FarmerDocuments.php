<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerDocuments extends Model
{
    use HasFactory;
    protected $table = 'farmer_documents';
    protected $fillable = [
      'farmer_certificate',
    ];

}
