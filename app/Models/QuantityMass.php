<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuantityMass extends Model
{
    use HasFactory;
    protected $table = 'quantity_mass';

    protected $fillable = [
        'name',
        'status',
        'description',
    ];
}
