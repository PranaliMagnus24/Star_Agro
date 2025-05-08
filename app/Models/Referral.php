<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;
    protected $table = 'referrals';
    
    protected $fillable = [
        'referral_code',
        'user_id',
        'parent_user_id',
    ]; 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Get the parent user (the one who referred).
     */
    public function parentUser ()
    {
        return $this->belongsTo(User::class, 'parent_user_id');
    }
}
