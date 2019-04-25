<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email', 'description', 'picture','country','city','street','buildingNumber','postalCode','hasOwner',
        'company_id','latitude','longitude','fullAddress'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function facilities(){
        return $this->belongsToMany(Facility::class);
    }
    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
