<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'name', 'crop', 'coordinates', 'area_id'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

}
