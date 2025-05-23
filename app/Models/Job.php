<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\State;
use Modules\Location\App\Models\District;
use Modules\Location\App\Models\Taluka;
use Modules\Location\App\Models\Village;




class Job extends Model
{
    use HasFactory;
    protected $table = 'registration_jobs'; 
    protected $fillable = [
    'first_name', 'last_name', 'applying_for','phone', 'email', 'state', 'district',
    'taluka', 'town', 'subject', 'description', 'cv',
];
public function states()
    {
        return $this->belongsTo(State::class, 'state','id');
    }

    // Relationship with District
    public function districts()
    {
        return $this->belongsTo(District::class, 'district','id');
    }

    // Relationship with Taluka
    public function talukas()
    {
        return $this->belongsTo(Taluka::class, 'taluka','id');
    }

    // Relationship with Village
    public function villages()
    {
        return $this->belongsTo(Village::class, 'town','id');
    }
    
    

}
