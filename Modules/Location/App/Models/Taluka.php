<?php

namespace Modules\Location\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Location\Database\factories\TalukaFactory;
use Modules\Location\App\Models\District;

class Taluka extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'district_id',
        'taluka_code',
        'taluka_name',
        'status',
    ];

    
    protected static function newFactory(): TalukaFactory
    {
        //return TalukaFactory::new();
    }
     public function district()
    {
        return $this->belongsTo(District::class);
    }
}
