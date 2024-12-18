<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JavaScript;
use App\User;
use App\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Event;
use App\Events\MessageSend;

class NotificationController extends Controller
{
    public function send(User $user , Request $request){
        $notification = new Notification;
        $notification->user_id = $user->id;
        $notification->body = $request->input('messageBody');
        $notification->receiver_id = $request->input('receiverId');
        $notification->save();
        event(new MessageSend($notification , User::find($notification->user_id)));
        return User::find($notification->user_id);
    }

    public function chatLogs($user , $receiver){
        return Notification::with(['sender' , 'receiver'])->orderBy('created_at' , 'ASC')->where((function ($query ) use ($receiver , $user) {
                                        $query->where('user_id' , '=' , $receiver)
                                              ->orWhere('user_id' , '=' , $user);
                                    }))->where((function ($query) use ($receiver , $user){
                                                    $query->where('receiver_id' , '=' , $receiver)
                                                          ->orWhere('receiver_id' , '=' , $user);
                                    }))->get();
    }
}
