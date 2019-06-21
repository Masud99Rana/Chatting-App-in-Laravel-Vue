<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Message;
use App\Events\MessageSent;
// use App\Events\PrivateMessageSent;

use Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }
    public function sendMessage(Request $request)
    {
        $message=auth()->user()->messages()->create(['message'=>$request->message]);

        broadcast(new MessageSent(auth()->user(),$message->load('user')))->toOthers(); 
       
        return response(['status'=>'Message sent successfully','message'=>$message]);
    }
   
}