<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorNodeType extends Model
{
    protected $fillable = ['name', 'sensor_node_id'];

    public function sensorNodes()
    {
        return $this->belongsTo(SensorNode::class, 'sensor_node_id');
    }
}
