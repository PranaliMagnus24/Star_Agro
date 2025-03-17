<?php

namespace Modules\GeneralSetting\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralSetting\Database\factories\GeneralSettingFactory;

class GeneralSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'general_settings';
    protected $fillable = ['website_name', 'description', 'favicon_logo','header_logo','footer_logo','email','phone','address','gst_number','location_url'];

    protected static function newFactory(): GeneralSettingFactory
    {
        //return GeneralSettingFactory::new();
    }
}
