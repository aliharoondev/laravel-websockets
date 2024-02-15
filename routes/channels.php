<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
use App\Models\Chat;

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

//Broadcast::channel('chat.{receiverId}', function (User $user, $receiverId) {
//    logger('Yup!!!');
////    logger(['receiverId' => $receiverId]);
////    return $user->id == $receiverId;
//});

Broadcast::channel('chat.{sender}.{receiver}', function ($user) {
    return !is_null($user);
});

//return $user->id === Chat::findOrNew($receiverId)->receiver_id;

//Broadcast::channel('chat.{receiverId}', function ($user, $receiverId) {
//    return $user->id == $receiverId;
//});

//Broadcast::channel('chat', function ($user) {
//    return $user;
//});
