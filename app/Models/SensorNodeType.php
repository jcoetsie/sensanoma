<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorNodeType extends Model
{
    public function sensorNodes()
    {
        return $this->belongsTo(SensorNode::class);
    }
}
