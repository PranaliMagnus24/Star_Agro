<?php

namespace Modules\MasterSetting\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\MasterSetting\Database\factories\WhatsappFactory;

class Whatsapp extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): WhatsappFactory
    {
        //return WhatsappFactory::new();
    }
}
