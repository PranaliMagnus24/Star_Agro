<?php

namespace Modules\Members\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\CropInquiry;
// use Modules\Members\Database\factories\EnquiryWalletTransactionFactory;

class EnquiryWalletTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'enquiry_wallets_transactions'; 
    protected $fillable = [
        'wallet_id',
        'enquiry_id',
        'type',
        'amount',
        'description',
    ];
    
    // protected static function newFactory(): EnquiryWalletTransactionFactory
    // {
    //     //return EnquiryWalletTransactionFactory::new();
    // }
    public function wallet()
    {
        return $this->belongsTo(EnquiryWallet::class, 'wallet_id');
    }

    public function cropInquiry()
    {
        return $this->belongsTo(CropInquiry::class, 'enquiry_id');
    }
}
