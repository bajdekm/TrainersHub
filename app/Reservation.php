<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function disciplineTrainer(){
        return $this->belongsTo('App\discipline_trainer','discipline_trainer_id');
    }
    public function gym(){
        return $this->belongsTo(Gym::class);
    }
    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }
    public function discipline(){
        return $this->belongsTo(Discipline::class);
    }

}
