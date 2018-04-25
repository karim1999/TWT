<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $fillable= [
        "name", "description", "img"
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function members(){
        return $this->belongsToMany('App\User', 'group_user');
    }

    public function messages(){
        return $this->morphMany('App\Message', 'messagable');
    }

    public function lastMessage(){
        return $this->morphMany('App\Message', 'messagable')->latest()->limit(1);
    }


}