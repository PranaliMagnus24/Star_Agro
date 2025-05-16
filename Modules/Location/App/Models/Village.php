<?php

namespace Modules\Location\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Location\Database\factories\VillageFactory;
use Modules\Location\App\Models\Taluka;

class Village extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
   protected $fillable = [
        'taluka_id',
        'village_code',
        'village_name',
        'village_status',
        'village_category',
        'status'
    ];
    
    protected static function newFactory(): VillageFactory
    {
        //return VillageFactory::new();
    }
    public function taluka()
    {
        return $this->belongsTo(Taluka::class, 'taluka_id');
    }
}
