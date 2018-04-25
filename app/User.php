<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function LatestMessageSent(){
        return $this->hasMany('App\Message')->latest()->limit(1);
    }

    public function LatestMessageReceived(){
        return $this->morphMany('App\Message', 'messagable')->latest()->limit(1);
    }

    public function groups(){
        return $this->belongsToMany('App\Group', 'group_user');
    }

    public function receivedMessages(){
        return $this->morphMany('App\Message', 'messagable');
    }

    public function seen(){
        return $this->hasMany('App\MessageSeen');
    }
}
