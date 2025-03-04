<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Reservation;

class Driver extends Model
{
    protected $table = 'driver';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'availability', 
        'longitude',
        'latitude'
    ];

    public function reservations(){
        return $this->hasMany(Reservation::class, 'driver_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id');
    }
}
