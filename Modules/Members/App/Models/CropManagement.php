<?php

namespace Modules\Members\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Members\Database\factories\CropManagementFactory;
use App\Models\User;

class CropManagement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'crop_management';
    protected $fillable = ['farmer_id','category_id','subcategory_id','crop_id','crop_name','planating_date','expected_price','min_qty','max_qty','type','description','status','harvesting_start_date', 'harvesting_end_date'];

    protected static function newFactory(): CropManagementFactory
    {
        //return CropManagementFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }
}
