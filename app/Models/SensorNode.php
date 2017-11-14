<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorNode extends Model
{
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
