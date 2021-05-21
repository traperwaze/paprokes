<?php

use Illuminate\Support\Facades\Broadcast;

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

//Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});

Broadcast::channel((config('channel.record') . '.{device_id}'), function (\App\Models\User $user, $device_id) {
   return !!$user->devices()->where('device_id', $device_id)->first();
});

Broadcast::channel('record', function () {
    return \Illuminate\Support\Facades\Auth::check();
});