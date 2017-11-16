<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorNode extends Model
{
    protected $fillable = ['name', 'type', 'zone_id'];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function getTypeAttribute($type)
    {
        return config('sensanoma.sensor_types')[$type];
    }
}
