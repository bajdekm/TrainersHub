<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'picture','country','city','street','buildingNumber','postalCode','user_id','latitude','longitude'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function gyms(){
        return $this->hasMany(Gym::class);
    }
    public function trainers(){
        return $this->hasMany(Trainer::class);
    }
}
