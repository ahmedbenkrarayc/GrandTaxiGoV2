<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Driver;
use App\Models\User;
use App\Models\Trajet;

class Reservation extends Model
{
    protected $table = 'reservation';
    protected $fillable = [
        'status',
        'driver_id',
        'passenger_id'
    ];

    public function driver(){
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function passenger(){
        return $this->belongsTo(User::class, 'passenger_id');
    }

    public function trajet(){
        return $this->hasOne(Trajet::class, 'reservation_id');
    }
}
