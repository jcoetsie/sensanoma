<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function areas()
    {
    	return $this->hasMany(Area::class);
    }

    public function sensorNodes()
    {
        return $this->hasMany(SensorNode::class);
    }

    public function zones()
    {
        return $this->hasManyThrough(Zone::class, Area::class);
    }
}
