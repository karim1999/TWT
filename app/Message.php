<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable= ['message'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function messagable(){
        return $this->morphTo();
    }

    public function seen(){
        return $this->hasMany('App\MessageSeen');
    }

}
