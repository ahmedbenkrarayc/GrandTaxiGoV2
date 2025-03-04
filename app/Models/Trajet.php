<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Reservtion;

class Trajet extends Model
{
    protected $table = 'trajet';
    protected $fillable = [
        'startDateTime',
        'startPlace', 
        'destination',
        'longtitude',
        'latitude',
        'reservation_id'
    ];

    public function reservation(){
        return $this->belongsTo(Reservtion::class, 'reservation_id');
    }
}
