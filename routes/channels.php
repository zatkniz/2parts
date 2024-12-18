<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
use Illuminate\Support\Facades\Auth;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('fund', function ($user) {
    return true;
  });

Broadcast::channel('chat-channel.{receiver_id}', function ($message , $receiver_id) {
    return true;
  });

Broadcast::channel('duty', function () {
    return true;
  });
