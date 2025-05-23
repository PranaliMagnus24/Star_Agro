<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'states';
    protected $fillable = [
       'name','country_id','country_code','fips_code','iso2','type','latitude','longitude','flag',
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'state', 'id');
}


}
