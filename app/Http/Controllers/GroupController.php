<?php

namespace App\Http\Controllers;

use App\Group;
use App\Message;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //


    public function index(){
        return Group::all();
    }


    public function show($id){
        $group= Group::findOrFail($id);
        return $group;
    }

    public function get_messages($id){
        $group= Group::findOrFail($id);
        $messages= $group->messages()->with('user')->get();
        return $messages;
    }


}