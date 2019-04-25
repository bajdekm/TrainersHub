<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function trainer(){
        return $this->belongsTo(Trainer::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
