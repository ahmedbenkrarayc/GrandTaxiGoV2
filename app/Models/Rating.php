<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Rating extends Model
{
    protected $table = 'rating';
    protected $fillable = [
        'rate',
        'comment',
        'writer_role',
        'reservation_id'
    ];

    public function reservation(){
        return $this->belongsTo(reservation::class, 'reservation_id');
    }
}
