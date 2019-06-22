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



Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('chatapp', function ($user) {
    return auth()->check();
});

Broadcast::channel('privatechatapp.{receiverid}', function ($user, $receiverid) {
    if(auth()->check()){
        return $user;
    }
    // return (auth()->check() && in_array($receiverid, $user->friends));
});

Broadcast::channel('privateonlineuser', function ($user) {
    if(auth()->check()){
        return $user;
    }
    // return (auth()->check() && in_array($receiverid, $user->friends));
});