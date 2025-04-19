<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuantityMass extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'quantity_mass';

    protected $fillable = [
        'name',
        'status',
        'description',
    ];
}
