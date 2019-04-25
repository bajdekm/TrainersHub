<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $fillable = [
        'name', 'country','voivodeship'
    ];
    //
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function trainers(){
        return $this->belongsToMany(Trainer::class);
    }
}
