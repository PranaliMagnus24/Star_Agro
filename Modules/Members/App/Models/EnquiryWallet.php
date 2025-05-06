<?php

namespace Modules\Members\App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Members\Database\factories\EnquiryWalletFactory;

class EnquiryWallet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'role_id',
        'wallet_name',
        'balance',
    ];
    
    // protected static function newFactory(): EnquiryWalletFactory
    // {
    //     //return EnquiryWalletFactory::new();
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function transactions()
    {
        return $this->hasMany(EnquiryWalletTransaction::class, 'wallet_id');
    }
}
