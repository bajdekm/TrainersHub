<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{

    protected $fillable = ['name','category','description','site','price'];

    public function trainers(){
        return $this->belongsToMany(Trainer::class);
    }
    public function reservations(){
        return $this->belongsToMany(Reservation::class);
    }
}
