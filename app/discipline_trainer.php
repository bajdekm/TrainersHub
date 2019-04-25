<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class discipline_trainer extends Model
{
    protected $fillable = ['price','minutesDuration','hoursDuration','quantity'];
    protected $table = "discipline_trainer";

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }
    public function discipline(){
        return $this->belongsTo(Discipline::class);
    }

}
