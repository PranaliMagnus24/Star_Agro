<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RazorpayPayment extends Model
{
    use HasFactory;
    protected $table = 'razorpaypayments';
    protected $fillable = ['user_id','amount', 'status','payment_date'];
}
