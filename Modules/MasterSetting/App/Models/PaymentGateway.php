<?php

namespace Modules\MasterSetting\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MasterSetting\Database\factories\PaymentGatewayFactory;

class PaymentGateway extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'payment_gateways';

    protected $fillable = ['api_key', 'secret_key', 'payment','status'];

    protected static function newFactory(): PaymentGatewayFactory
    {
        //return PaymentGatewayFactory::new();
    }
}
