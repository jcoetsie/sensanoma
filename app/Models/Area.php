<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

	protected $fillable = ['name', 'address', 'coordinates'];
	
    public function account()
    {
    	return $this->belongsTo(Account::class);
    }

    public function zones()
    {
        return $this->hasMany(Zone::class);
    }

    public function getCoordinatesAttribute($coordinates)
	{
        return \GuzzleHttp\json_decode($coordinates);
	}
}
