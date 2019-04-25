<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','login','surname','site','picture','register_origin','trainer_id','sex'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function company(){
        return $this->hasOne(Company::class);
    }
    public function gyms(){
        return $this->belongsToMany(Gym::class);
    }

    public function reservations(){
        return $this->hasMany('App\Reservation','user_id');
    }

    public function cities(){
        return $this->belongsToMany(Cities::class);
    }

    public function opinions(){
        return $this->hasMany('App\Opinion','user_id');
    }

    public function messages(){
        return $this->hasMany('App\Message','user_id');
    }

    public function trainer(){
        return $this->hasOne('App\Trainer');
    }

    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized.');
    }

    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
}
