<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function index(){
        return User::all();
    }


    public function show($id){
        $user= User::findOrFail($id);
        return $user;
    }

    public function getCurrentUser(){
        return Auth::guard("admin")->user();
    }

    public function getUserPicture($id){
        $user= User::findOrFail($id);
        return $user->img;
    }

    public function get_messages($id){
        $user_id= Auth::id();
        $messages= Message::where('messagable_type', 'App\User')->where(function($query)use ($user_id, $id){

            $query->where(function ($query)use ($user_id, $id){
                $query->where('user_id', $user_id)->where('messagable_id', $id);
            })->orWhere(function ($query)use ($user_id, $id){
                $query->where('user_id', $id)->where('messagable_id', $user_id);
            });

        })->with('user')->get();
        return $messages;
    }

    public function get_groups(){
        $user= Auth::user();
        $groups= $user->groups;
        $groups= $groups->each(function ($group){
            return $group->lastMessage;
        });
        return $groups;
    }

}
