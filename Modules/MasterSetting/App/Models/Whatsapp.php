<?php

namespace Modules\MasterSetting\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MasterSetting\Database\factories\WhatsappFactory;

class Whatsapp extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'whatsapps';
    protected $fillable = ['api_key','status'];

    protected static function newFactory(): WhatsappFactory
    {
        //return WhatsappFactory::new();
    }
}
