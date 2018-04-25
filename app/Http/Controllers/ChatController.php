<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Group;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use JavaScript;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
//        $this->middleware(['auth','isVerified']);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= Auth::user();
        $user_id= Auth::id();
        $groups= $user->groups;
        $groups= $groups->each(function ($group){
            return $group->lastMessage;
        });

        $messages= Message::where('messagable_type', 'App\User')->where(function($query)use ($user_id){

            $query->where(function ($query)use ($user_id){
                $query->where('user_id', $user_id)->orWhere('messagable_id', $user_id);
            });

        })->orderBy('id', 'desc')->with('user')->get();

        $friends= $messages->map(function ($item) use ($user_id) {
            if($user_id == $item->user_id)
                return $item->messagable;
            else
                return $item->user;
        })->unique();

        $friends= $friends->map(function ($friend) use ($user_id){

            $friend->last_message= Message::where('messagable_type', 'App\User')->where(function( $query)use ($user_id, $friend){

                $query->where(function ($query)use ($user_id, $friend){
                    $query->where('user_id', $user_id)->where('messagable_id', $friend->id);
                })->orwhere(function ($query)use ($user_id, $friend){
                    $query->where('user_id', $friend->id)->where('messagable_id', $user_id);
                });


            })->orderBy('id', 'Desc')->first();
            return $friend;
        });

        $storage= Storage::url("");

        JavaScript::put([
            'user' => $user,
            'storage' => $storage,
            'groups' => $groups,
            'friends' => $friends
        ]);
        return view('full');
    }

}
