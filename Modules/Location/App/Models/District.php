<?php

namespace Modules\Location\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Location\Database\factories\DistrictFactory;
use App\Models\State;

class District extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'state_id',
        'district_code',
        'district_name',
        'status',
    ];
    
    protected static function newFactory(): DistrictFactory
    {
       
    }
    public function states()
{
    return $this->belongsTo(State::class,'state_id');
}
}
