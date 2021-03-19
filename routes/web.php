<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/{key}/{channel}/{event}/{message}', function ($key, $channel, $event, $message) {
    try {
        $pusher = new Pusher\Pusher(
            $key,
            config('pusher.secret'),
            config('pusher.id'),
            [
                'cluster' => config('pusher.cluster'),
                'useTLS' => true
            ]
        );

        $data = base64_decode($message);
        $data = json_decode($data, true);

        $pusher->trigger($channel, $event, $data);

        return response()->json(['message' => 'Success']);
    } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
    }
});
