<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorNode extends Model
{
    protected $fillable = ['name', 'zone_id'];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function sensorNodeTypes()
    {
        return $this->hasMany(SensorNodeType::class);
    }
}
