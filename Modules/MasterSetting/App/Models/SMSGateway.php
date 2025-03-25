<?php

namespace Modules\MasterSetting\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\MasterSetting\Database\factories\SMSGatewayFactory;

class SMSGateway extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 's_m_s_gateways';
    protected $fillable = ['api_key', 'status'];

    protected static function newFactory(): SMSGatewayFactory
    {
        //return SMSGatewayFactory::new();
    }
}
