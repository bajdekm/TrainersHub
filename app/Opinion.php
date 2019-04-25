<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    protected $fillable = [
        'id', 'user_id', 'trainer_id','approved','rating','comment'
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }
}
