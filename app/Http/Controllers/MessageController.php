<?php

namespace App\Http\Controllers;

use App\Events\GroupMessageSent;
use App\Events\UserMessageSent;
use App\Group;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    //

    function sendToGroup($id, Request $request){
        $user= Auth::user();
        $group= Group::findOrFail($id);
        $msg= new Message;
        $msg->messagable()->associate($group);
        $msg->message= $request->message;
        $message= $user->messages()->save($msg);
        broadcast(new GroupMessageSent($message, $group))->toOthers();
        return $message;
    }

    function sendToUser($id, Request $request){
        $user= Auth::user();
        $receiver= User::findOrFail($id);
        $msg= new Message;
        $msg->messagable()->associate($receiver);
        $msg->message= $request->message;
        $message= $user->messages()->save($msg);
        broadcast(new UserMessageSent($message, $receiver))->toOthers();
        return $message;
    }

}
