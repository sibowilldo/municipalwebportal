<?php

use App\Incident;
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

Broadcast::channel('incident.{id}', function ($user, $id) {
    return $user->id === Incident::findOrNew($id)->user_id;
});

// Add the messages public channel
Broadcast::channel('newIncidentChannel', function() {
    return true;
});

// Add the incidentMessages public channel
Broadcast::channel('incidentUpdatedChannel', function() {
    return true;
});
