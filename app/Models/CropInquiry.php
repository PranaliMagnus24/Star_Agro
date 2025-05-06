<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Members\App\Models\EnquiryWalletTransaction;
use Modules\Members\App\Models\CropManagement;

class CropInquiry extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'crops_inquiry';
    protected $fillable = ['name', 'email', 'mobile_number','crop_management_id','crop_name','description','city',

];


public function city()
{
    return $this->belongsTo(City::class, 'city', 'id');
}

public function walletTransactions()
{
    return $this->hasMany(EnquiryWalletTransaction::class, 'enquiry_id');
}

public function cropManagement()
{
    return $this->belongsTo(CropManagement::class, 'crop_management_id');
}
public function user()
{
    return $this->belongsTo(User::class,'crop_management_id');
}
}
