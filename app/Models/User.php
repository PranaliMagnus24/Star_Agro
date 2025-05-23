<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;// add this for softdelete
use Modules\Members\App\Models\CropManagement;
use Str;
//bavix
// use Bavix\Wallet\Traits\HasWallet;
// use Bavix\Wallet\Interfaces\Wallet;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

// class User extends Authenticatable
class User extends Authenticatable 
{
    use HasApiTokens, HasRoles, HasFactory, Notifiable,SoftDeletes; //add softdelete

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    protected $fillable = [
        'name','email','password','phone','first_name','last_name','terms','gender','dob','state','district','pincode','taluka','town','referral_code',
        'known_about_us','company_name','country','solar_dryer','gst_no','aadhar_pancard',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function cities()
    {
        return $this->belongsTo(City::class, 'city', 'id');
    }
    public function states()
    {
        return $this->belongsTo(State::class, 'state', 'id');
    }
    public function countries()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    public function zips()
    {
        return $this->belongsTo(Zipcode::class, 'zip_id', 'id');
    }

    // public function farmerDocument()
    // {
    //     return $this->hasOne(FarmerDocuments::class, 'user_id', 'id');
    // }
    public function farmerDocuments()
    {
        return $this->hasMany(FarmerDocuments::class, 'user_id', 'id');
    }
    public function cropManagement()
    {
        return $this->hasMany(CropManagement::class, 'farmer_id'); 
    }
    
    // protected static function booted()
    // {
    //     static::creating(function ($user) {
    //         $user->referral_code = strtoupper(Str::random(8));
    //     });
    // }
}
