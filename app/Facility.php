<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = ['name','category'];

    public function gyms(){
        return $this->belongsToMany(Gym::class);
    }
}
