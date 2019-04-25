<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{

    protected $fillable = [
        'id', 'name', 'surname','description','competences','experiences','user_id','company_id','buildingNumber','flatNumber',
        'email','phone','city','street','postalCode','instagramProfile','facebookProfile','snapchatProfile',
        'picture','picture2','picture3','website','sex','voivodeship'
    ];

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function opinions(){
        return $this->hasMany(Opinion::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function disciplines(){
        return $this->belongsToMany(Discipline::class)->withPivot('price','minutesDuration','hoursDuration','quantity');
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function cities(){
        return $this->belongsToMany(Cities::class);
    }
}
